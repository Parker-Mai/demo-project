@extends('frontend.layouts.main')

@section('content')

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="/">
            <img src="{{URL::asset('assets/fontend/images/main_logo.jpg')}}" alt="">
          </a>
          <h2 class="text-center">建立您的帳號</h2>
          <form class="text-left clearfix" action="/frontend/member-center/signin" method="post">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control"  name="member_name" id="member_name" placeholder="輸入登入帳號" value="{{old('member_name')}}">
              @error('member_name')
              <small style="color:red;">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  name="member_password" id="member_password" placeholder="輸入登入密碼">
              @error('member_password')
              <small style="color:red;">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <input type="password" class="form-control"  name="member_password_confirmation" placeholder="確認密碼">
            </div>
            <div class="form-group">
              <input type="text" class="form-control"  name="member_realname" id="member_realname" placeholder="輸入真實姓名" value="{{old('member_realname')}}">
              @error('member_realname')
              <small style="color:red;">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <input type="email" class="form-control"  name="member_email" id="member_email" placeholder="您的電子信箱" value="{{old('member_email')}}">
              @error('member_email')
              <small style="color:red;">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" class="form-control"  name="member_phone" id="member_phone" placeholder="您的聯絡手機" value="{{old('member_phone')}}">
              @error('member_phone')
              <small style="color:red;">{{$message}}</small>
              @enderror
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-main text-center">加入會員</button>
            </div>
          </form>
          <p class="mt-20">已經是會員了 ?<a href="/member-center/login_page"> 登入</a></p>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection