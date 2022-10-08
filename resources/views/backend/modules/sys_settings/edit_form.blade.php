@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統功能 /</span> 系統資訊</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-body">

        <form action="/backend/sys_settings/update" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for=""></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name=""  id="" value="" placeholder="">
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection