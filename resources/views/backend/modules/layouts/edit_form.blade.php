@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> 畫面佈局</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/layouts/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="layout_name">佈局名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="layout_name"  id="layout_name" value="{{$layout_name}}" placeholder="佈局名稱">
            </div>
            @error('layout_name')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="layout_root">佈局路徑</label>
            <div class="col-sm-10">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon14">../resources/views/frontend/layouts/</span>
                <input type="text" class="form-control" name="layout_root"  id="layout_root" value="{{$layout_root}}" placeholder="佈局路徑">
                <span class="input-group-text" id="basic-addon13">.blade.php</span>
              </div>
              
            </div>
            @error('layout_root')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/layouts'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection