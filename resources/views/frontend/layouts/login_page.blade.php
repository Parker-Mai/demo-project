@extends('frontend.layouts.main')

@section('content')

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.html">
            <img src="{{URL::asset('assets/fontend/images/main_logo.jpg')}}" alt="">
          </a>
          <h2 class="text-center">歡迎回來</h2>

          <form class="text-left clearfix" method="post" action="/frontend/member-center/login">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="login_name" id="login_name" placeholder="帳號">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="login_password" id="login_password" placeholder="密碼">
            </div>
            <div class="text-center">
              <button type="button" onclick="location.href='/frontend/member-center/google/auth'" class="btn btn-main text-center" >Google登入</button>
              <button type="submit" class="btn btn-main text-center" >登入</button>
            </div>

          </form>

          <p class="mt-20">還沒加入會員嗎？<a href="/frontend/member-center/signin_page">加入會員</a></p>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection