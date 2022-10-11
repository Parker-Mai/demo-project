@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">信仰價值</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li class="active">信仰價值</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">

	<div class="container">

		<div class="row">

			@foreach($out_data as $data)
			<div class="col-md-6">
				<div class="post">

					<div class="post-thumb">
						<img class="img-responsive" src="{{asset('storage/'.$data['db_our_quality_img'].'')}}" alt="">
					</div>
					
					<h2 class="post-title"><a href="blog-single.html">{{$data['db_our_quality_title']}}</a></h2>

					<div class="post-content" >
						<p>{!! nl2br($data['db_our_quality_content']) !!}</p>
					</div>

				</div>
			</div>
			@endforeach

		</div>
		
	</div>
</div>


@endsection