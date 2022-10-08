<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Members;
use App\Models\Products;
use App\Models\ProductCarts;
use Illuminate\Http\Request;
use App\Models\MemberAddresses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function list(Request $request){

        // $this->authorize('list', $product);

        $datas = Orders::latest()->paginate(15);

        return view('backend.modules.orders.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);
    }

    public function create_page(){

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
            return json_encode(['status' => 'NO','error' => 'auth'],JSON_UNESCAPED_UNICODE);
        }

        //檢查 是否有選擇付款方式
        if(empty($request->payment_method)) return json_encode(['status' => 'NO','error' => 'required','field' => '付款方式'],JSON_UNESCAPED_UNICODE);
        //檢查 聯絡電話
        if(empty($request->contact_phone)) return json_encode(['status' => 'NO','error' => 'required','field' => '聯絡電話'],JSON_UNESCAPED_UNICODE);
        //檢查是否有輸入門市店號
        if($request->payment_method == 1){
            if(empty($request->local_number)) return json_encode(['status' => 'NO','error' => 'required','field' => '門市店號'],JSON_UNESCAPED_UNICODE);
        }
        //檢查 收件地址收件人
        if($request->payment_method == 2){
            if(empty($request->order_address)) return json_encode(['status' => 'NO','error' => 'required','field' => '收件人及收件地址'],JSON_UNESCAPED_UNICODE);
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
        $order_total = 0;
        foreach($product_carts as $product_cart){
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
            'order_uid' => $order_uid,
            'member_id' => $member_id,
            'local_number' => $request->local_number,
            'payment_method' => $request->payment_method,
            'contact_phone' => $request->contact_phone,
            'order_address' => $request->order_address,
            'shipping' => $shipping,
            'order_total' => $order_total,
            'status' => 1
        ];

        //綠界api物流串接
        $link_api = $this->ecpay_api_link($save_data);

        if(!$link_api) return json_encode(['status' => 'NO','error' => 'api'],JSON_UNESCAPED_UNICODE);

        $save_data['api_trade_uid'] = $link_api['1|AllPayLogisticsID'];
        $save_data['api_payment_no'] = $link_api['CVSPaymentNo'];

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

            return json_encode(['status' => 'NO','error' => 'save'],JSON_UNESCAPED_UNICODE);
        }else{
            DB::commit();
        }

        return json_encode(['status' => 'YES'],JSON_UNESCAPED_UNICODE);
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


    public function ecpay_api_link($data){

        $memeber = Members::find($data['member_id']);

        $address = MemberAddresses::find($data['order_address']);

        $url = "https://logistics-stage.ecpay.com.tw/Express/Create";


        if($data['payment_method'] == 1){ // 711 C2C

            $hashkey = 'XBERn1YOvpM9nfZc';
            $hashiv = 'h1ONHk4P4yqbl5LK';
            $merchant_id = '2000933';
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

            $hashkey = '5294y06JbISpM5x9';
            $hashiv = 'v77hoKGq4kWxNNIS';
            $merchant_id = '2000132';
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

}
