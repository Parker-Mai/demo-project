@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統功能 /</span> 模組分類</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/module_categorys/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="category_name">分類名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="category_name"  id="category_name" value="{{$category_name}}" placeholder="分類名稱">
            </div>
            @error('category_name')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/module_categorys'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection