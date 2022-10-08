@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">經典巧克力</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li><a href="#">經典商品</a></li>
						<li class="active">經典巧克力</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="products section">
	<div class="container">
		<div class="row">

			<!-- 左側條件欄 START -->
			<div class="col-md-3">

				<!-- 左側上條件欄 START -->
				<div class="widget">
					<h4 class="widget-title">分類搜尋</h4>
					<select class="form-control" id="cateogry_search">
						<option value="0">全部</option>
						<option value="1">生巧克力</option>
						<option value="2">松露</option>
						<option value="3">珠寶盒</option>
					</select>
				</div>
				<!-- 左側上條件欄 END -->

			</div>
			<!-- 左側條件欄 END -->


			<!-- 右側商品列 START -->
			<div class="col-md-9">

				<div class="row">

					<!-- 商品列 START-->
					@foreach($out_data['datas'] as $data)

					<div class="col-md-4">
						<a href="?flag=detail&ids={{$data['id']}}">
							<div class="product-item">
								<div class="product-thumb">
									@if($data['product_quantity'] < 1)
									<span class="bage">Sale</span>
									@endif
									<img class="img-responsive" src="{{asset('storage/'.$data['product_img'].'')}}" alt="product-img" />
								</div>
								<div class="product-content">
									<h4>{{$data['product_name']}}</h4>
									<p class="price">${{$data['product_price']}}</p>
								</div>
							</div>
						</a>
					</div>
					@endforeach
					<!-- 商品列 END-->
					
				</div>

				{{$out_data['datas']->links('vendor.pagination.frontend-pagebar')}}

				
			</div>
			<!-- 右側商品列 END -->

		</div>
	</div>
</section>



@endsection