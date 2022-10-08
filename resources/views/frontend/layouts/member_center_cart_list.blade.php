@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">會員中心</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li class="active">會員中心</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="user-dashboard page-wrapper">
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline dashboard-menu text-center">
          <li><a href="/frontend/member-center/profile">個人資料</a></li>
          <li><a class="active" href="#">購物車</a></li>
          <li><a href="/frontend/member-center/order_list">訂單查詢</a></li>
        </ul>

        <div class="page-wrapper">
          <div class="cart shopping">
            <div class="container">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="block">
                    <div class="product-list">
                      <form method="post">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>商品</th>
                              <th>單價</th>
                              <th>購買數量</th>
                              <th>小計</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($out_data['datas'] as $data)
                            <tr class="member_center_cart_data" data-id="{{$data['id']}}">
                              <td>
                                <div class="product-info">
                                  <img width="80" src="{{asset('storage/'.$data['product_detail']['product_img'].'')}}" alt="">

                                  @switch($data['product_detail']['product_main_category'])
                                    @case(1)
                                      <a href="/frontend/chocolate?flag=detail&ids={{$data['product_detail']['id']}}" target="_blank">{{$data['product_detail']['product_name']}}</a>
                                      @break;
                                    @case(2)
                                      <a href="/frontend/cake?flag=detail&ids={{$data['product_detail']['id']}}" target="_blank">{{$data['product_detail']['product_name']}}</a>
                                      @break;
                                    @case(3)
                                      <a href="/frontend/miyuki-cake?flag=detail&ids={{$data['product_detail']['id']}}" target="_blank">{{$data['product_detail']['product_name']}}</a>
                                      @break;
                                  @endswitch
                                </div>
                              </td>
                              <td>${{$data['product_detail']['product_price']}}</td>
                              <td>{{$data['quantity']}}</td>
                              <td>${{$data['total']}}</td>
                              <td>
                                <a class="product-remove delete_cart" href="javascript:void(0);" data-id="{{$data['id']}}">Remove</a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <hr>
                        <span>總計：${{$out_data['all_product_total']}}</span>
                        <a href="/frontend/check-out" class="btn btn-main pull-right">我要結帳</a>
                      </form>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
        

      </div>
    </div>
  </div>
</section>

@endsection
