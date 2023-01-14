@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">商品結帳</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li class="active">商品結帳</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="page-wrapper">

  <div class="checkout shopping">
    <div class="container">
      <a href="/frontend/member-center/cart_list" class="btn btn-main btn-medium btn-round">回購物車</a>

      <form action="/frontend/member_create_order" method="post" id="order_form">
        @csrf
        <div class="row">
          <!-- 左側付款資訊列 START -->
          <div class="col-md-8">
            <!-- 付款資料 START -->
            <div class="block billing-details">
              <h4 class="widget-title">付款資料</h4>

              <div class="form-group">
                  <label >付款方式</label>
                  <select class="form-control" name="payment_method" id="payment_method">
                    <option value="">請選擇</option>
                    <option value="1">7-11取貨付款(70元)</option>
                    <option value="2">宅配:黑貓貨到付款(60元)</option>
                    <option value="3">信用卡一次付清</option>
                  </select>
              </div>

              <div class="form-group paymethod_credit">
                <span style="color:red">*金流功能完成度80%，可正常運作。</span><br>
                <span style="color:red">*測試環境，信用卡號請使用4311-9522-2222-2222，安全碼為222。</span><br>
                <span style="color:red">*測試環境，請勿留真實或重要資訊。</span>
              </div>

              <div class="form-group paymethod_711">
                  <label for="user_address">收貨門市店號 <span style="color:red">*因測試環境 7-11取貨一定要用 131386</span></label>
                  <input class="form-control" type="text" name="local_number" id="local_number" >
                  <button type="button" class="btn btn-default search_local">搜尋門市</button>
                  <div>
                    <img src="{{URL::asset('assets/fontend/images/note.jpg')}}" alt="" style="max-width:400px;">
                  </div>
              </div>

            </div>
            <!-- 付款資料 END -->

            <!-- 收件人資料 START -->
            <div class="block">
              <h4 class="widget-title">收件人資料</h4>

              <div class="form-group">
                  <label for="full_name">帳號</label>
                  <p>{{$out_data['member_data']->member_name}}({{$out_data['member_data']->member_realname}})</p>
              </div>

              <div class="form-group">
                  <label for="">聯絡電話</label>
                  <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{$out_data['member_data']->member_phone}}" placeholder="">
              </div>

              <div class="form-group order_address">
                <label for="">收件人及收件地址</label>
                <select class="form-control" name="order_address" id="order_address">
                  <option value="">請選擇</option>
                  @foreach($out_data['member_address_data'] as $address_data_key => $address_data_val)
                  <option value="{{$address_data_key}}">{{$address_data_val}}</option>
                  @endforeach
                </select>
              </div>
              
            </div>
            <!-- 收件人資料 END -->
          </div>
          <!-- 左側付款資訊列 END -->

          <!-- 右側商品資訊列 START -->
          <div class="col-md-4">
            <div class="product-checkout-details">
                <div class="block">
                  <h4 class="widget-title">訂單摘要</h4>

                  <!-- 商品列 START-->
                  @foreach($out_data['cart_data'] as $cart_data)

                  <div class="media product-card">
                      
                      @switch($cart_data['product_detail']['product_main_category'])
                        @case(1)
                          <a class="pull-left" target="_blank" href="/frontend/chocolate?flag=detail&ids={{$cart_data['product_detail']['id']}}">
                          @break
                        @case(2)
                          <a class="pull-left" target="_blank" href="/frontend/cake?flag=detail&ids={{$cart_data['product_detail']['id']}}">
                          @break
                        @case(3)
                          <a class="pull-left" target="_blank" href="/frontend/miyuki-cake?flag=detail&ids={{$cart_data['product_detail']['id']}}">
                          @break
                      @endswitch
                        <img class="media-object" src="{{asset('storage/'.$cart_data['product_detail']['product_img'].'')}}" alt="Image">
                      </a>

                      <div class="media-body">
                        <h4 class="media-heading">{{$cart_data['product_detail']['product_name']}}</h4>
                        <p class="price">{{$cart_data['quantity']}} x ${{$cart_data['product_detail']['product_price']}}</p>
                        <span>${{$cart_data['total']}}</span>
                      </div>

                  </div>

                  @endforeach
                  <!-- 商品列 END-->

                  <ul class="summary-prices">
                      <li>
                        <span>小計:</span>
                        <span class="price product_total" data-price="{{$out_data['all_product_total']}}">${{$out_data['all_product_total']}}</span>
                      </li>
                      <li>
                        <span>運費:</span>
                        <span class="shipping">$0</span>
                      </li>
                  </ul>

                  <div class="summary-total">
                      <span>總計:</span>
                      <span class="order_total">${{$out_data['all_product_total']}}</span>
                  </div>

                </div>
            </div>
          </div>
          <!-- 右側商品資訊列 END -->

        </div>

        <button type="button" class="btn btn-main btn-medium btn-round" id="order_submit">確認送出</button>

      </form>

    </div>
  </div>
</div>

<script>

  $(function(){
    $('.paymethod_711,.paymethod_credit').hide();
  })

  $('#payment_method').change(function(){

    switch($(this).val()){
      case "1":
        var shipping = 70;
        $('.paymethod_711').show();
        $('.order_address,.paymethod_credit').hide();
        break;
      case "2":
        var shipping = 60;
        $('.order_address').show();
        $('.paymethod_711,.paymethod_credit').hide();
        break;
      case "3":
        var shipping = 0;
        $('.paymethod_credit').show();
        $('.order_address,.paymethod_711').hide();
        break;
      default: 
        var shipping = 0;
        break;
    }

    $('.shipping').html("$"+shipping);

    var order_total = parseInt(shipping) + parseInt($('.product_total').attr('data-price'));

    $('.order_total').html("$"+order_total);

  })

  $('#order_submit').click(function(){

    if(!confirm("是否確定送出訂單？")){
      return false;
    }else{
      $('#order_form').submit();
    }

  })

  // $('#order_submit').click(function(){
    
  //   if(!confirm("是否確定送出訂單？")){
  //     return false;
  //   }

  //   $.ajax({
  //     url: "/frontend/member_create_order",
  //     type: "POST",
  //     dataType: "json",
  //     data: {
  //       "_token": "{{ csrf_token() }}",
  //       "payment_method": $('#payment_method').val(),
  //       "local_number": $('#local_number').val(),
  //       "contact_phone": $('#contact_phone').val(),
  //       "order_address": $('#order_address').val(),
  //     },
  //     success: function (data) {
  //       console.log(data);

  //       if(data.status != 'YES'){
          
  //         switch(data.error){
  //           case 'auth':
	// 						alert('請先登入會員'); location.href="/frontend/login_page";
	// 						break;
  //           case 'required':
  //             alert(data.field+" 不得為空");
  //             break;
  //           case 'api':
  //             alert('系統錯誤(A001)，請聯絡我們');
  //             break;
  //           case 'save':
	// 						alert('系統錯誤(A002)，請聯絡我們');
	// 						break;
  //         }

  //       }else{
  //         alert('訂單建立成功');
  //         location.href="/frontend/member-center/order_list";
  //       }
        
  //     },
  //     error: function (a) {
  //       console.log(a);
  //     }
  //   });

  // })

  $('.search_local').click(function(){

    window.open('https://emap.pcsc.com.tw/#','',config='height=900,width=900,toolbar=no,left=500px');

  })

</script>

@endsection
