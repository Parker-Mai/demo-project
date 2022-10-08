@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">關於我們</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li class="active">關於我們</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about section">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<img class="img-responsive" src="{{asset('storage/'.$out_data[0]['db_about_us_img'].'')}}">
			</div>
			<div class="col-md-6">
				<h2 class="mt-40">關於我們</h2>
				<p>{{$out_data[0]['db_about_us_content']}}</p>
			</div>
		</div>
	</div>
</section>

@endsection