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
            <label class="col-sm-2 " for="">作業系統</label>
            <div class="col-sm-10">
              {{$sys_os}}
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 " for="">PHP版本</label>
            <div class="col-sm-10">
              {{$sys_php_version}}
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 " for="">資料庫版本</label>
            <div class="col-sm-10">
              {{$sys_db_version}}
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_name">系統名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_name" id="sys_name" value="{{$sys_name}}">
            </div>
            @error('sys_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_logo">系統LOGO</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="sys_logo" id="sys_logo">
            </div>
          </div>

          @if(!empty($sys_logo))
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <img src="{{asset('storage/'.$sys_logo)}}" style="max-width:150px;max-height:150px">
            </div>
          </div>
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_start_date">系統啟動日期</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_start_date" id="sys_start_date" value="{{$sys_start_date}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_end_date">系統關閉日期</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_end_date" id="sys_end_date" value="{{$sys_end_date}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_deny_ip">不允許連線IP</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="sys_deny_ip" id="sys_deny_ip" rows="5">{{$sys_deny_ip}}</textarea>
            </div>
          </div>
          

          <div class="divider">
            <div class="divider-text">綠界API介接</div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_api_id">特店編號</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_api_id" id="sys_api_id" value="{{$sys_api_id}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_api_hashkey">HashKey</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_api_hashkey" id="sys_api_hashkey" value="{{$sys_api_hashkey}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_api_hashiv">HashIV</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_api_hashiv" id="sys_api_hashiv" value="{{$sys_api_hashiv}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_api_ctc_id">特店編號(物流C2C)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_api_ctc_id" id="sys_api_ctc_id" value="{{$sys_api_ctc_id}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_api_ctc_hashkey">HashKey(物流C2C)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_api_ctc_hashkey" id="sys_api_ctc_hashkey" value="{{$sys_api_ctc_hashkey}}">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="sys_api_ctc_hashiv">HashIV(物流C2C)</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sys_api_ctc_hashiv" id="sys_api_ctc_hashiv" value="{{$sys_api_ctc_hashiv}}">
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

<script>

$(function(){
  $('#sys_start_date,#sys_end_date').datepicker({
    dateFormat:"yy/mm/dd",
    changeMonth: true,
    changeYear: true,
  });
})
</script>

@endsection