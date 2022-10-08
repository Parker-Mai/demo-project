@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">{{$out_data['title']}}</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li><a href="#">經典商品</a></li>
						<li class="active">{{$out_data['title']}}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="products section">
	<div class="container">
		<div class="row">
			
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
		</div>
	</div>
</section>

@endsection
