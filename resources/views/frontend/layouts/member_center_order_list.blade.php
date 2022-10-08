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
					<li><a href="/frontend/member-center/cart_list">購物車</a></li>
					<li><a class="active" href="/frontend/member-center/order_list">訂單查詢</a></li>
				  </ul>

				<div class="dashboard-wrapper user-dashboard">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>訂單編號</th>
									<th>建立日期</th>
									<th>訂單總價</th>
									<th>訂單狀態</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($out_data['datas'] as $data)
								<tr>
									<td>{{$data['order_uid']}}</td>
									<td>{{$data['created_at']}}</td>
									<td>${{$data['order_total']}}</td>
									<td>
										@switch($data['status'])
											@case(1)
												<span class="label label-primary">訂單處理中</span>
												@break;
											@case(2)
												<span class="label label-info">已出貨</span>
												@break;
											@case(3)
												<span class="label label-success">訂單完成</span>
												@break;
											@case(4)
												<span class="label label-danger">已取消</span>
												@break;
										@endswitch
									</td>
									<td><button type="button" class="btn btn-default order_detail" data-id="{{$data['id']}}">檢視</button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal order-modal fade" id="order-modal" style="display: none;">

	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<i class="tf-ion-close"></i>
	</button>

	<div class="modal-dialog " role="document">

		<div class="modal-content">
			<div class="modal-body">
				<div class="row">

					<div class="dashboard-wrapper ">
						<div class="media">
						  <div class="media-body">
							<h2 class="media-heading">訂單編號：<span class="order_uid"></span></h2>
							<p>付款方式：<span class="payment_method"></span></p>
							<p>聯絡電話：<span class="contact_phone"></span></p>
							<p class="order_address_block">收件地址：<span class="order_address"></span></p>
							<p>收件人：<span class="order_addressee"></span></p>
							<p class="local_number_block">門市：<span class="local_number"></span></p>
						  </div>
						</div>
					</div>

					<div class="dashboard-wrapper user-dashboard">
						<div class="table-responsive">
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
								<tbody class="model_product_row">
								  
								</tbody>
							  </table>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

</div>


<script type="text/html" id="model_product_row_html">

<tr class="data_row">
	<td>
		<div class="product-info">
			<img width="80" src="{{asset('storage/[product_img]')}}" alt="">
			<span>[product_name]</span>
		</div>
	</td>
	<td>$[product_price]</td>
	<td>[product_quantity]</td>
	<td>$[product_total]</td>
</tr>

</script>

<script>

	$('.order_detail').click(function(){

		$('.model_product_row').find('.data_row').remove();

		$('.order_address_block,.local_number_block').show();

		var order_id = $(this).data('id');

		$.ajax({
			url: "/frontend/view_order_detail",
			type: "POST",
			dataType: "json",
			data: {
				"_token": "{{ csrf_token() }}",
				"order_id": order_id,
			},
			success: function (data) {
				console.log(data);

				if(data.status == 'YES'){
					
					$('#order-modal').find('.order_uid').html(data.order_data['order_uid']);

					if(data.order_data['payment_method'] == 1){
						$('#order-modal').find('.payment_method').html("7-11貨到付款");
						$('#order-modal').find('.order_addressee').html(data.member['member_realname']);
					}else{
						$('#order-modal').find('.payment_method').html("宅配：黑貓");

						if(data.member_address['addressee'] != ''){
							$('#order-modal').find('.order_addressee').html(data.member_address['addressee']);
						}
						
					}

					
					$('#order-modal').find('.contact_phone').html(data.order_data['contact_phone']);
					
					$('#order-modal').find('.order_addressee').html(data.order_data['order_addressee']);

					if(data.member_address != ''){
						$('#order-modal').find('.order_address').html(data.member_address['zipcode']+data.member_address['city']+data.member_address['area']+data.member_address['address']);
					}else{
						$('#order-modal').find('.order_address_block').hide();
					}
					if(data.order_data['local_number'] != ''){
						$('#order-modal').find('.local_number').html("新竹市東區建中一路52號1樓(建盛門市)");
					}else{
						$('#order-modal').find('.local_number_block').hide();
					}
					
					
					for(var i=0;i<data.order_products.length;i++){
						
						let data_row = $("#model_product_row_html").html();

						data_row = data_row.replace("[product_img]",data.order_products[i]['product_detail']['product_img']);
						data_row = data_row.replace("[product_name]",data.order_products[i]['product_detail']['product_name']);
						data_row = data_row.replace("[product_price]",data.order_products[i]['product_detail']['product_price']);
						data_row = data_row.replace("[product_quantity]",data.order_products[i]['quantity']);
						data_row = data_row.replace("[product_total]",data.order_products[i]['total']);

						$('.model_product_row').append(data_row);
					}

					$("#order-modal").modal('show');
				}else{
					
					switch(data.error){
						case 'auth':
							alert('請先登入會員'); location.href="/frontend/login_page";
							break;
					}

				}
				
			},
			error: function (a) {
				console.log(a);
			}
		});

		

	})
	
</script>


@endsection