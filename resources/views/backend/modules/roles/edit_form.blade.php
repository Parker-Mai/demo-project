@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統功能 /</span> 系統權限</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/roles/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="role_name">角色名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="role_name" id="role_name" value="{{$role_name}}">
            </div>
            @error('role_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>
  

          <input type="hidden" name="permission[]">        

          @foreach($permissions as $model_name => $permission_name_arr)
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="">{{$model_name}}</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">

                @foreach($permission_name_arr as $permission_id => $permission_name)
                <div class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" name="permission[{{$permission_id}}]" id="permission_{{$permission_id}}" value="1"
                  @if(in_array($permission_id,$permission_role_list))
                    checked
                  @endif
                  >
                  <label class="form-check-label" for="permission_{{$permission_id}}">{{$permission_name}}</label>
                </div>
                @endforeach

              </div>
            </div>
          </div>
          @endforeach

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/roles'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection