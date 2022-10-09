@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> Banner管理</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/banners/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="title">標題</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="title"  id="title" value="{{$title}}" placeholder="標題">
            </div>
            @error('title')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="link">連結</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="link"  id="link" value="{{$link}}" placeholder="連結">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="banner_img">Banner 上傳</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="banner_img"  id="banner_img">
            </div>
            @error('banner_img')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>

          @if(!empty($banner_img))
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <img src="{{asset('storage/'.$banner_img)}}" style="max-width:1000px;max-height:1000px">
            </div>
          </div>
          @endif

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/banners'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection