<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Members;
use App\Models\Products;
use App\Models\SysSettings;
use App\Models\ProductCarts;
use Illuminate\Http\Request;
use App\Models\MemberAddresses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

use Ecpay\Sdk\Factories\Factory;
use Ecpay\Sdk\Services\UrlService;

class OrderController extends Controller
{

    public function list(Request $request,Orders $order){

        $this->authorize('list', $order);

        $datas = Orders::latest()->paginate(15);

        return view('backend.modules.orders.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);
    }

    public function create_page(Orders $order){

        $this->authorize('create', $order);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_orders'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }
        }

        $out['action'] = 'create';

        return view('backend.modules.orders.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'layout_name'  => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
        ],[
            'layout_name'  => '佈局名稱',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/orders/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        Orders::create($input_data);
        
        return redirect('/backend/orders');
    }

    public function update_page(Orders $order){

        $this->authorize('update', $order);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{

            $out = $order;
            
        }

        //抓收件人收件地址

        if(!empty($out['order_address'])){
            $member_addresses = MemberAddresses::find($order->order_address);

            $out['all_address'] = $member_addresses->zipcode.$member_addresses->city.$member_addresses->area.$member_addresses->address;
            $out['addressee'] = $member_addresses->addressee;
        }else{
            $out['all_address'] = "";
            $out['addressee'] = "";
        }
        
        
        $out['action'] = 'update/'.$order['id'];


        return view('backend.modules.orders.edit_form',$out);
    }

    public function update(Request $request,Orders $order){

        $input_data = $request->all();

        $order->update([
            'status' => $input_data['status'],
        ]);
        
        return redirect('/backend/orders');
    }

    public function delete(Orders $order){

        $this->authorize('delete', $order);

        if(!$order->trashed()){
            $order->delete();
        }
        
        return redirect('/backend/orders');
    }



    public function front_data_switch($frame_data,$request,$view_root){

        //檢查是否登入
        if(!Auth::guard('web')->check()){
            return redirect()->to('../frontend/member-center/login_page')->send();
        }

        $member_id = Auth::guard('web')->user()->id;

        $out_data = [];

        // 開始抓會員資料
        $member_data = Members::find($member_id);

        // 會員地址資料
        $member_address_arr = MemberAddresses::where('member_id','=',$member_id)->get()->toArray();

        foreach($member_address_arr as $key => $val){
            $member_address_data[$val['id']] = $val['zipcode'].$val['city'].$val['area'].$val['address']."。收件人：".$val['addressee'];
        }

        // 抓會員購物車資料
        $cart_data = ProductCarts::where('member_id','=',$member_id)->where('order_id','=',null)->get()->toArray();

        $all_product_total = 0;
        foreach($cart_data as $k => $v){
            
            $product = Products::find($v['product_id'])->toArray();

            $cart_data[$k]['product_detail'] = $product;

            $all_product_total += $v['total'];
        }
        

        $out_data = [
            'view_root' => $view_root,
            'member_data' => $member_data,
            'member_address_data' => $member_address_data,
            'cart_data' => $cart_data,
            'all_product_total' => $all_product_total,
        ];

        return $out_data;

    }

    public function member_create_order(Request $request){

        //檢查是否登入
        if(!Auth::guard('web')->check()){

            return redirect('/frontend/login_page')->with('front_system_message', '請先登入會員。');

        }

        $required_error = [];
        
        //檢查 是否有選擇付款方式
        if(empty($request->payment_method)) $required_error[] = '付款方式';
        //檢查 聯絡電話
        if(empty($request->contact_phone)) $required_error[] = '聯絡電話';
        //檢查是否有輸入門市店號
        if($request->payment_method == 1){
            if(empty($request->local_number)) $required_error[] = '門市店號';
        }
        //檢查 收件地址收件人
        if($request->payment_method == 2){
            if(empty($request->order_address)) $required_error[] = '收件人及收件地址';
        }
        
        if(count($required_error) > 0){

            return back()->with('front_system_message',implode('、',$required_error).' 不得為空。');

        }

        $member_id = Auth::guard('web')->user()->id;

        
        //運費
        switch($request->payment_method){
            case 1: $shipping = 70; break;
            case 2: $shipping = 70; break;
            default: $shipping = 0;
        }

        //開始計算訂單總計
        //抓購物車所有商品
        $product_carts = ProductCarts::where('member_id','=',$member_id)->where('order_id','=',null)->get();
        $product_cart_arr = [];
        $order_total = 0;
        foreach($product_carts as $product_cart){
            $product_cart_arr[] = $product_cart->product_id;
            $order_total += $product_cart->total;
        }
        $order_total += $shipping;


        //產生流水號
        //先抓最後一筆訂單
        $order = Orders::orderBy('id', 'desc')->first();

        if(empty($order)){
            $last_order_uid = "0000";
        }else{
            $last_order_uid = $order->order_uid;
        }

        $last_order_uid = (int)substr($last_order_uid,-4,4);
        $last_order_uid++;
        $order_uid = "#".date('Ymd').str_pad($last_order_uid,4,0,STR_PAD_LEFT);

        $save_data = [
            'order_uid'         => $order_uid,
            'member_id'         => $member_id,
            'local_number'      => $request->local_number,
            'payment_method'    => $request->payment_method,
            'contact_phone'     => $request->contact_phone,
            'order_address'     => $request->order_address,
            'shipping'          => $shipping,
            'product_cart_arr'  => $product_cart_arr,
            'order_total'       => $order_total,
            'status'            => 1
        ];

        if($request->payment_method != 3){

            //綠界api物流串接
            $link_api = $this->ecpay_api_link($save_data);

            $save_data['api_trade_uid'] = $link_api['1|AllPayLogisticsID'];

            $save_data['api_payment_no'] = $link_api['CVSPaymentNo'];

            if(!$link_api) return back()->with('front_system_message','系統錯誤(A001)，請聯絡我們');

            //進DB
            $chk = $this->order_in_db($save_data,$member_id);

        }else{

            //進DB
            $chk = $this->order_in_db($save_data,$member_id);

            //綠界金流
            $this->ecpay_api_payment($save_data);

        }
        
        if(!$chk){

            return back()->with('front_system_message','系統錯誤(A002)，請聯絡我們');

        }else{

            return redirect('/frontend/member-center/order_list')->with('front_system_message', '訂單建立成功。');

        }    
        
    }

    public function show_api_status_client(Request $request){

        if($request->RtnCode != 1){
            return redirect('/frontend/member-center/cart_list')->with('front_system_message', '系統錯誤(A003)，請聯絡我們');
        }else{
            return redirect('/frontend/index')->with('front_system_message', '訂單建立成功。');
        }

    }

    public function order_in_db($save_data,$member_id){

        //開始建立訂單
        $save_controller = true;
        DB::beginTransaction();

        $save_order = Orders::create($save_data);

        if(!$save_order) $save_controller = false;

        //更改購物車商品狀態
        $cart_datas = ProductCarts::where('member_id','=',$member_id)->where('order_id','=',null)->get();
        
        foreach($cart_datas as $cart_data){
            
            $save_cart = $cart_data->update([
                'order_id' => $save_order->id,
            ]);

            if(!$save_cart) $save_controller = false;
        }

        if(!$save_controller){
            DB::rollBack();

            return false;
        }else{
            DB::commit();

            return true;
        }

    }

    public function view_order_detail(Request $request){
        
        //檢查是否登入
        if(!Auth::guard('web')->check()){
            return json_encode(['status' => 'NO','error' => 'auth'],JSON_UNESCAPED_UNICODE);
        }

        //訂單
        $order = Orders::find($request->order_id)->toArray();

        //訂單商品
        $order_products = ProductCarts::where('order_id','=',$order['id'])->get()->toArray();

        foreach($order_products as $k => $v){
            
            $product = Products::find($v['product_id'])->toArray();

            $order_products[$k]['product_detail'] = $product;
        }

        //收件人 收件地址
        if(!empty($order['order_address'])){
            $member_address = MemberAddresses::find($order['order_address'])->toArray();
        }else{
            $member_address = '';
        }
        

        return json_encode([
            'status' => 'YES',
            'order_data' => $order,
            'order_products' => $order_products,
            'member_address' => $member_address,
            'member' => Members::find($order['member_id'])->toArray()
        ],JSON_UNESCAPED_UNICODE);
    }


    //綠界物流api
    public function ecpay_api_link($data){

        $memeber = Members::find($data['member_id']);

        $address = MemberAddresses::find($data['order_address']);

        $sys_data = SysSettings::first();

        $url = "https://logistics-stage.ecpay.com.tw/Express/Create";

        // print_a($data);die();

        if($data['payment_method'] == 1){ // 711 C2C

            $hashkey = $sys_data['sys_api_ctc_hashkey'];
            $hashiv = $sys_data['sys_api_ctc_hashiv'];
            $merchant_id = $sys_data['sys_api_ctc_id'];
            $type = 'CVS';
            $sub_type = 'UNIMARTC2C';

            $api_data = [
                'HashKey'           => $hashkey,
                'GoodsAmount'       => $data['order_total'],
                'GoodsName'         => 'ChoChoco巧克力專賣',
                'LogisticsSubType'  => $sub_type,
                'LogisticsType'     => $type,
                'MerchantID'        => $merchant_id,
                'MerchantTradeDate' => date('Y-m-d H:i:s'),
                'ReceiverCellPhone' => $data['contact_phone'],
                'ReceiverName'      => $memeber->member_realname,
                'ReceiverStoreID'   => $data['local_number'],
                'SenderCellPhone'   => '0922123123',
                'SenderName'        => '測試廠商',
                'ServerReplyURL'    => 'http://127.0.0.1/frontend/show_api_status',
                'HashIV'            => $hashiv,
            ];

            $send_data = [
                'GoodsAmount' => $data['order_total'],
                'GoodsName' => 'ChoChoco巧克力專賣',
                'LogisticsSubType' => $sub_type,
                'LogisticsType' => $type,
                'MerchantID' => $merchant_id,
                'MerchantTradeDate' => date('Y-m-d H:i:s'),
                'ReceiverCellPhone' => $memeber->member_phone,
                'ReceiverName' => $memeber->member_realname,
                'ReceiverStoreID' => $data['local_number'],
                'SenderCellPhone' => '0922123123',
                'SenderName' => '測試廠商',
                'ServerReplyURL' => 'http://127.0.0.1/frontend/show_api_status',
            ];

        }else{ //黑貓宅配

            $hashkey = $sys_data['sys_api_hashkey'];
            $hashiv = $sys_data['sys_api_hashiv'];
            $merchant_id = $sys_data['sys_api_id'];
            $type = 'HOME';
            $sub_type = 'TCAT';

            $api_data = [
                'HashKey'           => $hashkey,
                'GoodsAmount'       => $data['order_total'],
                'GoodsName'         => 'ChoChoco巧克力專賣',
                'LogisticsSubType'  => $sub_type,
                'LogisticsType'     => $type,
                'MerchantID'        => $merchant_id,
                'MerchantTradeDate' => date('Y-m-d H:i:s'),
                
                'ReceiverAddress'   => $address->city.$address->area.$address->address,
                'ReceiverCellPhone' => $data['contact_phone'],
                'ReceiverName'      => $address->addressee,
                'ReceiverStoreID'   => $data['local_number'],
                'ReceiverZipCode'   => $address->zipcode,

                'SenderAddress'     => "新北市板橋區重慶路999號",
                'SenderCellPhone'   => '0922123123',
                'SenderName'        => '測試廠商',
                'SenderZipCode'     => "220",
                'ServerReplyURL'    => 'http://127.0.0.1/frontend/show_api_status',
                'HashIV'            => $hashiv,
            ];

            $send_data = [
                'GoodsAmount'       => $data['order_total'],
                'GoodsName'         => 'ChoChoco巧克力專賣',
                'LogisticsSubType'  => $sub_type,
                'LogisticsType'     => $type,
                'MerchantID'        => $merchant_id,
                'MerchantTradeDate' => date('Y-m-d H:i:s'),
                
                'ReceiverAddress'   => $address->city.$address->area.$address->address,
                'ReceiverCellPhone' => $data['contact_phone'],
                'ReceiverName'      => $address->addressee,
                'ReceiverStoreID'   => $data['local_number'],
                'ReceiverZipCode'   => $address->zipcode,

                'SenderAddress'     => "新北市板橋區重慶路999號",
                'SenderCellPhone'   => '0922123123',
                'SenderName'        => '測試廠商',
                'SenderZipCode'     => "220",
                'ServerReplyURL'    => 'http://127.0.0.1/frontend/show_api_status',
            ];
        }
       

        $api_data_str = "";
        $counter = 1;
        foreach($api_data as $k => $v){

            if($counter == 1){
                $api_data_str .= $k.'='.$v;
            }else{
                $api_data_str .= '&'.$k.'='.$v;
            }

            $counter++;
        }

        $checkvalue = strtoupper(md5(strtolower(urlencode($api_data_str))));

        $send_data['CheckMacValue'] = $checkvalue;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data); 
        $result = curl_exec($ch);
        curl_close($ch);

        // print_a($result);die();

        if(explode("|",$result)[0] == 1){

            $results = explode('&',urldecode($result));
           
            $out_arr = [];
            foreach($results as $data){
                
                $data_process = explode('=',$data);

                $out_arr[$data_process[0]] = $data_process[1];


            }
            // print_a($out_arr);die();
            return $out_arr;

        }else{
            
            return false;
        }

    }

    //綠界金流api
    public function ecpay_api_payment($data){
        
        //處理訂單商品字串 START
            $order_content = "";
            for($i=0;$i<count($data['product_cart_arr']);$i++){

                $products = Products::find($data['product_cart_arr'][$i]);

                $order_content .= $products->product_name;
                
                if($i != count($data['product_cart_arr'])-1){
                    $order_content .= "#";
                }

            }
        //處理訂單商品字串 END

        // $url = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";

        // $api_data = [
        //     'HashKey'           => 'pwFHCqoQZGmho4w6',
        //     'ChoosePayment'     => 'Credit',
        //     'EncryptType'       => 1,
        //     'ItemName'          => '測試商品',
        //     'MerchantID'        => '3002607',
        //     'MerchantTradeDate' => date('Y/m/d H:i:s'),
        //     'MerchantTradeNo'   => 'ORDER'.date('YmdHis'),
        //     'PaymentType'       => 'aio',
        //     'ReturnURL'         => 'http://127.0.0.1/frontend/show_api_status',
        //     'TotalAmount'       => $data['order_total'],
        //     'TradeDesc'         => 'Demo金流串接',
        //     'HashIV'            => 'EkRm7iFT261dpevs'
        // ];

        // $send_data = [
        //     'ChoosePayment'     => 'Credit',
        //     'EncryptType'       => 1,
        //     'ItemName'          => '測試商品',
        //     'MerchantID'        => '3002607',
        //     'MerchantTradeDate' => date('Y/m/d H:i:s'),
        //     'MerchantTradeNo'   => 'ORDER'.date('YmdHis'),
        //     'PaymentType'       => 'aio',
        //     'ReturnURL'         => 'http://127.0.0.1/frontend/show_api_status',
        //     'TotalAmount'       => $data['order_total'],
        //     'TradeDesc'         => 'Demo金流串接',
        // ];

        // $api_data_str = "";
        // $counter = 1;
        // foreach($api_data as $k => $v){

        //     if($counter == 1){
        //         $api_data_str .= $k.'='.$v;
        //     }else{
        //         $api_data_str .= '&'.$k.'='.$v;
        //     }

        //     $counter++;
        // }

        // $checkvalue = strtolower(urlencode($api_data_str));

        // $search = [
        //     '%2d',
        //     '%5f',
        //     '%2e',
        //     '%21',
        //     '%2a',
        //     '%28',
        //     '%29',
        // ];
        // $replace = [
        //     '-',
        //     '_',
        //     '.',
        //     '!',
        //     '*',
        //     '(',
        //     ')',
        // ];
        // $checkvalue = str_replace($search, $replace, $checkvalue);

        // $checkvalue = strtoupper(hash('sha256',$checkvalue));

        // $send_data['CheckMacValue'] = $checkvalue;

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data); 
        // $result = curl_exec($ch);
        // curl_close($ch);


        $factory = new Factory([
            'hashKey' => 'pwFHCqoQZGmho4w6',
            'hashIv' => 'EkRm7iFT261dpevs',
        ]);
        $autoSubmitFormService = $factory->create('AutoSubmitFormWithCmvService');
        
        $input = [
            'MerchantID'        => '3002607',
            'MerchantTradeNo'   => 'ORDER' . time(),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'PaymentType'       => 'aio',
            'TotalAmount'       => $data['order_total'],
            'TradeDesc'         => UrlService::ecpayUrlEncode('Demo金流串接，請勿流真實資料。'),
            'ItemName'          => $order_content,
            'ChoosePayment'     => 'Credit',
            'EncryptType'       => 1,
        
            'ReturnURL' => 'http://127.0.0.1:8000/frontend/show_api_status',
            'OrderResultURL' => 'http://127.0.0.1:8000/frontend/show_api_status_client',
        ];

        $action = 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5';
        
        echo $autoSubmitFormService->generate($input, $action);
        die();

    }
}
