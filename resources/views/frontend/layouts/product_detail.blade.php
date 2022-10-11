@extends('frontend.layouts.main')

@section('content')

<section class="single-product">
	<div class="container">

		<!-- 上方麵包屑 START -->
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="/">首頁</a></li>
					<li><a href="#">經典商品</a></li>
					<li class="active">經典巧克力</li>
				</ol>
			</div>
		</div>
		<!-- 上方麵包屑 END -->

		<!-- 產品資訊 START -->
		<div class="row mt-20">

			<!-- 左側圖片 START --> 
			<div class="col-md-5">

				<div class="single-product-slider">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>

								<div class='item active'>
									<img src="{{asset('storage/'.$out_data['datas']->product_img.'')}}" alt='' data-zoom-image="{{asset('storage/'.$out_data['datas']->product_img.'')}}"  style="width:100%;"/>
								</div>
								
							</div>
							
							<!-- sag sol -->
							<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
								<i class="tf-ion-ios-arrow-left"></i>
							</a>
							<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
								<i class="tf-ion-ios-arrow-right"></i>
							</a>
						</div>
						
						<!-- thumb -->
						{{-- <ol class='carousel-indicators mCustomScrollbar meartlab'>
							<li data-target='#carousel-custom' data-slide-to='0' class='active'>
								<img src='images/shop/single-products/product-1.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='1'>
								<img src='images/shop/single-products/product-2.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='2'>
								<img src='images/shop/single-products/product-3.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='3'>
								<img src='images/shop/single-products/product-4.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='4'>
								<img src='images/shop/single-products/product-5.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='5'>
								<img src='images/shop/single-products/product-6.jpg' alt='' />
							</li>
							<li data-target='#carousel-custom' data-slide-to='6'>
								<img src='images/shop/single-products/product-7.jpg' alt='' />
							</li>
						</ol> --}}

					</div>
				</div>

			</div>
			<!-- 左側圖片 END --> 

			<!-- 右側資訊 START --> 
			<div class="col-md-7">
				<div class="single-product-details">
					<h2>{{$out_data['datas']->product_name}}</h2>
					<p class="product-price">${{$out_data['datas']->product_price}}</p>
					
					<p class="product-description mt-20">
						{!! nl2br($out_data['datas']->product_description) !!}
					</p>

					<div class="product-quantity">
						<span>庫存:</span>
						<p>{{$out_data['datas']->product_quantity}}</p>
					</div>

					<div class="product-quantity">
						<span>購買數量:</span>
						<div class="product-quantity-slider">
							<input name="product-quantity" id="product-quantity" type="text" value="0">
						</div>
					</div>

					@if(!empty($out_data['datas']->product_category))
					<div class="product-category">
						<span>分類:</span>
						<ul>
							@foreach($out_data['datas']->product_category as $val)
							<li><a href="#">{{$val}}</a></li>
							@endforeach
						</ul>
					</div>
					@endif
					
					@if($out_data['datas']->product_quantity > 0)
					<a href="javascript:void(0);" class="btn btn-main mt-20 add_cart" data-id="{{$out_data['datas']->id}}">加入購物車</a>
					@endif
				</div>
			</div>
			<!-- 右側資訊 END -->

		</div>
		<!-- 產品資訊 END -->

		<!-- 產品相關訊息欄 START -->
		<div class="row">

			<div class="col-xs-12">

				<div class="tabCommon mt-20">

					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#product_specification" aria-expanded="true">產品成分</a></li>
						<li class=""><a data-toggle="tab" href="#product_content" aria-expanded="false">產品內容</a></li>
					</ul>

					<div class="tab-content patternbg">

						<div id="product_specification" class="tab-pane fade active in">
							
							<p>{!! nl2br($out_data['datas']->product_specification) !!}</p>
							
						</div>

						<div id="product_content" class="tab-pane fade">

							<p>{!! nl2br($out_data['datas']->product_content) !!}</p>

						</div>

					</div>
				</div>
			</div>

		</div>
		<!-- 產品相關訊息欄 END -->

	</div>
</section>

<!-- 下方相關產品列 START -->
<section class="products related-products section">

	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>相關商品</h2>
			</div>
		</div>

		<div class="row">

			@foreach($out_data['related_products'] as $related_product)
			<div class="col-md-3">

				<div class="product-item">
					<div class="product-thumb">
						@if($related_product['product_quantity'] < 1)
                        <span class="bage">Sale</span>
                        @endif
						<img class="img-responsive" src="{{asset('storage/'.$related_product['product_img'].'')}}" alt="product-img" />
					</div>

					<div class="product-content">
						@switch($related_product['product_main_category'])
                        @case(1)
                            <h4><a href="../frontend/chocolate?flag=detail&ids={{$related_product['id']}}" target="_blank">{{$related_product['product_name']}}</a></h4>
                            @break
                        @case(2)
                            <h4><a href="../frontend/cake?flag=detail&ids={{$related_product['id']}}" target="_blank">{{$related_product['product_name']}}</a></h4>
                            @break
                        @case(3)
                            <h4><a href="../frontend/miyuki-cake?flag=detail&ids={{$related_product['id']}}" target="_blank">{{$related_product['product_name']}}</a></h4>
                            @break
                        @endswitch
						<p class="price">${{$related_product['product_price']}}</p>
					</div>
					
				</div>
				
			</div>
			@endforeach
		</div>
	</div>
</section>
<!-- 下方相關產品列 END -->

<script>

	$('.add_cart').click(function(){

		var product_id = $(this).data('id');
		var quantity = $('#product-quantity').val();

		$.ajax({

			url: "/frontend/add_cart",
			type: "POST",
			dataType: "json",
			data: {
				"_token": "{{ csrf_token() }}",
				"product_id": product_id,
				"quantity": quantity
			},
			success: function (data) {
				console.log(data);

				if(data.status == 'YES'){
					alert('加入成功');
				}else{
					
					switch(data.error){
						case 'auth':
							alert('請先登入會員');
							location.href="/frontend/member-center/login_page";
							break;
						case 'exist':
							alert('購物車已有該商品');
							break;
						case 'format':
							alert('數量請輸入正整數');
							break;
						case 'less':
							alert('數量請大於 1');
							break;
						case 'quantity':
							alert('欲購買數量超過該商品庫存');  location.reload();
							break;
						case 'save':
							alert('系統錯誤');
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