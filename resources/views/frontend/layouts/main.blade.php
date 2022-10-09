<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>ChoChoco巧克力專賣</title>

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Construction Html5 Template">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<meta name="author" content="Themefisher">
	<meta name="generator" content="Themefisher Constra HTML Template v1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets/fontend/images/favicon.pngs')}}" />

	<!-- Themefisher Icon font -->
	<link rel="stylesheet" href="{{URL::asset('assets/fontend/plugins/themefisher-font/style.css')}}">
	<!-- bootstrap.min css -->
	<link rel="stylesheet" href="{{URL::asset('assets/fontend/plugins/bootstrap/css/bootstrap.min.css')}}">

	<!-- Animate css -->
	<link rel="stylesheet" href="{{URL::asset('assets/fontend/plugins/animate/animate.css')}}">
	<!-- Slick Carousel -->
	<link rel="stylesheet" href="{{URL::asset('assets/fontend/plugins/slick/slick.css')}}">
	<link rel="stylesheet" href="{{URL::asset('assets/fontend/plugins/slick/slick-theme.css')}}">

	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="{{URL::asset('assets/fontend/css/style.css')}}">

	<!-- Main jQuery -->
	<script src="{{URL::asset('assets/fontend/plugins/jquery/dist/jquery.min.js')}}"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body id="body">

	<section class="top-header">
		<div class="container">
			<div class="row">

				<div class="col-md-4 col-xs-12 col-sm-4">
					<div class="contact-number">
						<i class="tf-ion-ios-telephone"></i>
						<span>0129- 12323-123123</span>
					</div>
				</div>

				<div class="col-md-4 col-xs-12 col-sm-4">
					<!-- Site Logo -->
					<div class="logo text-center">
						<a href="/">
							<!-- replace logo here -->
							<svg width="135px" height="29px" viewBox="0 0 155 29" version="1.1"
								xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
									font-size="25" font-family="AustinBold, Austin" font-weight="bold">
									<g id="Group" transform="translate(-108.000000, -297.000000)" fill="#000000">
										<text id="AVIATO">
											<tspan x="108.94" y="325">CHOCHOCO</tspan>
										</text>
									</g>
								</g>
							</svg>
						</a>
					</div>
				</div>

				<div class="col-md-4 col-xs-12 col-sm-4">

					<ul class="top-menu text-right list-inline">

						@auth('web')

						<li class="dropdown cart-nav dropdown-slide">

							<a href="#!" class="dropdown-toggle cart_list_bar" data-toggle="dropdown" data-hover="dropdown"><i class="tf-ion-android-cart"></i>購物車</a>

							<div class="dropdown-menu cart-dropdown">
								
								<div class="cart_list"></div>


								<div class="cart-summary">
									<span>Total</span>
									<span class="total-price all_product_total"></span>
								</div>

								<ul class="text-center cart-buttons">
									<li><a href="/frontend/member-center/cart_list" class="btn btn-small">檢視購物車</a></li>
									<li><a href="/frontend/check-out" class="btn btn-small btn-solid-border">我要結帳</a></li>
								</ul>

							</div>

						</li>

						@endauth
						
						

						<li>
							@auth('web')
							<a href="/frontend/member-center/logout"> 會員登出</a>
							@else
							<a href="/frontend/member-center/login_page"> 會員登入</a>
							@endauth
						</li>

						
					</ul>
				</div>
			</div>
		</div>
	</section>

	@if(session()->has('front_system_message'))
	<section class="alerts">
		<div class="container">
			<div class="row mt-30">
				<div class="col-xs-12">
					<div class="alertPart">
						<div class="alert alert-info alert-common alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<span>{{session('front_system_message')}}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	@endif

	<!-- Main Menu Section -->
	<section class="menu">

		<nav class="navbar navigation">
			<div class="container">

				<!-- Navbar Links -->
				<div id="navbar" class="navbar-collapse collapse text-center">
					<ul class="nav navbar-nav">

						<li class="dropdown ">
							<a href="/">首頁</a>
						</li>

						<li class="dropdown dropdown-slide">
							<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="350" role="button" aria-haspopup="true" aria-expanded="false">經典商品 <span class="tf-ion-ios-arrow-down"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/frontend/chocolate">經典巧克力</a></li>
								<li><a href="/frontend/cake">經典蛋糕</a></li>
								<li><a href="/frontend/miyuki-cake">彌月蛋糕</a></li>
							</ul>
						</li>

						<li class="dropdown ">
							<a href="/frontend/about-us">關於我們</a>
						</li>

						<li class="dropdown ">
							<a href="/frontend/our-quality">信仰價值</a>
						</li>

						<li class="dropdown ">
							<a href="/frontend/member-center/profile">會員中心</a>
						</li>

					</ul><!-- / .nav .navbar-nav -->

				</div>
				<!--/.navbar-collapse -->
			</div><!-- / .container -->
		</nav>
	</section>

	@yield('content')

	<!-- Footer區 START -->
	<footer class="footer section text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="social-media">
						<li>
							<a href="#">
								<i class="tf-ion-social-facebook"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="tf-ion-social-instagram"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="tf-ion-social-twitter"></i>
							</a>
						</li>
						<li>
							<a href="#">
								<i class="tf-ion-social-pinterest"></i>
							</a>
						</li>
					</ul>
					<p class="copyright-text">Copyright &copy;2022</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer區 END -->


	<!-- 
    Essential Scripts
    =====================================-->

	
	<!-- Bootstrap 3.1 -->
	<script src="{{URL::asset('assets/fontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<!-- Bootstrap Touchpin -->
	<script
		src="{{URL::asset('assets/fontend/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
	<!-- Instagram Feed Js -->
	<script src="{{URL::asset('assets/fontend/plugins/instafeed/instafeed.min.js')}}"></script>
	<!-- Video Lightbox Plugin -->
	<script src="{{URL::asset('assets/fontend/plugins/ekko-lightbox/dist/ekko-lightbox.min.js')}}"></script>
	<!-- Count Down Js -->
	<script src="{{URL::asset('assets/fontend/plugins/syo-timer/build/jquery.syotimer.min.js')}}"></script>

	<!-- slick Carousel -->
	<script src="{{URL::asset('assets/fontend/plugins/slick/slick.min.js')}}"></script>
	<script src="{{URL::asset('assets/fontend/plugins/slick/slick-animation.min.js')}}"></script>

	<!-- Google Mapl -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
	<script type="text/javascript" src="{{URL::asset('assets/fontend/plugins/google-map/gmap.js')}}"></script>

	<!-- Main Js File -->
	<script src="{{URL::asset('assets/fontend/js/script.js')}}"></script>

	<script type="text/html" id="cart_list_bar_html">

		<div class="media cart_data" data-id="[cart_id]">

			<a class="pull-left" href="#!">
				<img class="media-object" src="{{asset('storage/[product_img]')}}" alt="image" />
			</a>

			<div class="media-body">
				<h4 class="media-heading"><a href="#!">[product_name]</a></h4>
				<div class="cart-price">
					<span>[cart_quantity] x</span>
					<span>$[product_price]</span>
				</div>
				<h5><strong>$[cart_product_total]</strong></h5>
			</div>

			<a href="javascript:void(0);" class="remove delete_cart" data-id="[cart_id]"><i class="tf-ion-close"></i></a>

		</div>

	</script>

	<script type="text/javascript">

		$(function(){

			var getUrlString = location.href;
			var url = new URL(getUrlString);
			
			if(url.searchParams.get('type') != '' && url.searchParams.get('type') != null){
				
				$('#cateogry_search').val(url.searchParams.get('type'));
			}else{

				$('#cateogry_search').val("0");
			}

		})

		$('#cateogry_search').change(function(){

			if($(this).val() != 0){
				location.href = "?type=" + $(this).val();
			}else{
				location.href = "/frontend/chocolate";
			}
			
		
		});

		@auth('web')
		$('.cart_list_bar').mouseenter(function(){

			$('.cart_data').remove();
			$('.all_product_total').html();

			$.ajax({
				url: "/frontend/view_cart",
				type: "POST",
				dataType: "json",
				data: {
					"_token": "{{ csrf_token() }}",
				},
				success: function (data) {
					console.log(data);

					if(data.status != 'YES'){
						alert('請先登入會員'); location.href="/frontend/login_page";
					}
					var all_product_total = 0;

					for(var i=0;i<data.cart_data.length;i++){

						let cart_row = $('#cart_list_bar_html').html();

						cart_row = cart_row.replace("[cart_id]",data.cart_data[i]['id']);
						cart_row = cart_row.replace("[cart_id]",data.cart_data[i]['id']);
						cart_row = cart_row.replace("[product_img]",data.cart_data[i]['product_detail']['product_img']);
						cart_row = cart_row.replace("[product_name]",data.cart_data[i]['product_detail']['product_name']);
						cart_row = cart_row.replace("[cart_quantity]",data.cart_data[i]['quantity']);
						cart_row = cart_row.replace("[product_price]",data.cart_data[i]['product_detail']['product_price']);
						cart_row = cart_row.replace("[cart_product_total]",data.cart_data[i]['total']);

						all_product_total = parseInt(all_product_total) + parseInt(data.cart_data[i]['total']);

						$('.cart_list').append(cart_row);
					}

					$('.all_product_total').html('$'+all_product_total);
					
				},
				error: function (a) {
					console.log(a);
				}
			});
		})

		$(document).on('click','.delete_cart',function(){
			
			if(!confirm("是否要刪除該項目？")){
				return false;
			}

			var cart_id = $(this).data('id');

			$.ajax({
				url: "/frontend/delete_cart",
				type: "POST",
				dataType: "json",
				data: {
					"_token": "{{ csrf_token() }}",
					"cart_id": cart_id,
				},
				success: function (data) {
					console.log(data);

					if(data.status == 'YES'){
						
						$('.cart_data[data-id='+cart_id+']').remove();
						$('.member_center_cart_data[data-id='+cart_id+']').remove();
						
					}else{
						
						switch(data.error){
							case 'auth':
								alert('請先登入會員'); location.href="/frontend/login_page";
								break;
							case 'save':
								alert('系統錯誤，請聯絡我們');
								break;
						}

					}
					
				},
				error: function (a) {
					console.log(a);
				}
			});

		})
		@endauth
	</script>

</body>

</html>