@extends('frontend.layouts.main')

@section('content')

<!-- 中間banner輪播區 START -->
<div class="hero-slider">
    
    <div class="slider-item th-fullpage hero-area" style="background-image: url({{URL::asset('assets/fontend/images/banner-001.jpg')}});">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-8 text-center">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="slider-item th-fullpage hero-area" style="background-image: url({{URL::asset('assets/fontend/images/banner-002.jpg')}});">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-8 text-center">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="slider-item th-fullpage hero-area" style="background-image: url({{URL::asset('assets/fontend/images/banner-003.jpg')}});">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-8 text-center">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PRODUCTS</p>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">The beauty of nature <br> is hidden in details.</h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="shop.html">Shop Now</a>
                </div> --}}
            </div>
        </div>
    </div>

</div>
<!-- 中間banner輪播區 END -->

<!-- 產品分類區 START -->
<section class="product-category section" >

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-center">
                    <h2>經典商品</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-box">
                    <a href="../frontend/chocolate">
                        <img src="{{URL::asset('assets/fontend/images/category-001.jpg')}}" alt="" />
                        <div class="content">
                            <h3 style="font-weight: bold;">經典巧克力</h3>
                            {{-- <p>Shop New Season Clothing</p> --}}
                        </div>
                    </a>
                </div>
                <div class="category-box">
                    <a href="../frontend/cake">
                        <img src="{{URL::asset('assets/fontend/images/category-002.jpg')}}" alt="" />
                        <div class="content">
                            <h3 style="font-weight: bold;">經典蛋糕</h3>
                            {{-- <p>Get Wide Range Selection</p> --}}
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-box">
                    <a href="../frontend/miyuki-cake">
                        <img src="{{URL::asset('assets/fontend/images/category-003.jpg')}}" alt="" />
                        <div class="content">
                            <h3 style="font-weight: bold;color:white">彌月蛋糕</h3>
                            {{-- <p>Special Design Comes First</p> --}}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- 產品分類區 END -->

<!-- 熱銷單品 START -->
<section class="products section bg-gray">
    <div class="container">
        <div class="row">
            <div class="title text-center">
                <h2>熱銷單品</h2>
            </div>
        </div>
        <div class="row">

            <!-- 商品列 START-->

            @foreach($out_data['datas'] as $data)
            <div class="col-md-4">
                <div class="product-item">
                    <div class="product-thumb">
                        @if($data['product_quantity'] < 1)
                        <span class="bage">Sale</span>
                        @endif
                        <img class="img-responsive" src="{{asset('storage/'.$data['product_img'].'')}}" alt="product-img" />

                        <div class="preview-meta">
                            <ul>
                                <li>
                                    <a href="#!"><i class="tf-ion-android-cart"></i></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="product-content">
                        @switch($data['product_main_category'])
                        @case(1)
                            <h4><a href="../frontend/chocolate?flag=detail&ids={{$data['id']}}" target="_blank">{{$data['product_name']}}</a></h4>
                            @break
                        @case(2)
                            <h4><a href="../frontend/cake?flag=detail&ids={{$data['id']}}" target="_blank">{{$data['product_name']}}</a></h4>
                            @break
                        @case(3)
                            <h4><a href="../frontend/miyuki-cake?flag=detail&ids={{$data['id']}}" target="_blank">{{$data['product_name']}}</a></h4>
                            @break
                        @endswitch
                        <p class="price">${{$data['product_price']}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- 商品列 END-->

            <!-- 產品小跳窗 START -->
            <div class="modal product-modal fade" id="product-modal">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="tf-ion-close"></i>
                </button>
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <div class="modal-image">
                                        <img class="img-responsive"
                                            src="{{URL::asset('assets/fontend/images/shop/products/modal-product.jpg')}}"
                                            alt="product-img" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="product-short-details">
                                        <h2 class="product-title">GM Pendant, Basalt Grey</h2>
                                        <p class="product-price">$200</p>
                                        <p class="product-short-description">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto
                                            nihil cum. Illo laborum numquam rem aut officia dicta cumque.
                                        </p>
                                        <a href="cart.html" class="btn btn-main">Add To Cart</a>
                                        <a href="product-single.html" class="btn btn-transparent">View Product
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 產品小跳窗 END -->

        </div>
    </div>
</section>
<!-- 熱銷單品 END -->

@endsection