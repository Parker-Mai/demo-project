@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統功能 /</span> 系統帳號</h4>

<div class="row">
  <div class="col-md-12">

    <div class="card mb-4">

      <h5 class="card-header">新增</h5>

      <form action="/backend/accounts/{{$action}}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($action != 'create')
        @method('put')
        @endif
        
        <!-- 使用者照片 START -->
        <div class="card-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4">

            @if(!empty($account_photo))
            <img src="{{asset('storage/'.$account_photo);}}" class="d-block rounded" height="100" width="150" id="uploadedAvatar" />
            @endif
            

            <div class="button-wrapper">

              <label for="account_photo" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">上傳新照片</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file" class="account-file-input" name="account_photo" id="account_photo">
              </label>

              <p class="text-muted mb-0">允許 JPG, GIF 或 PNG. 最大容量 800K</p>

            </div>
          </div>
        </div>
        <!-- 使用者照片 END -->

        <hr class="my-0" />

        <!-- 資料輸入form START -->
        <div class="card-body">

            <div class="row">

              <div class="mb-3 col-md-6">
                <label for="account_name" class="form-label">系統帳號</label>
                <input type="text" class="form-control"  name="account_name" id="account_name" value="{{$account_name}}" autofocus />

                @error('account_name')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>


              <div class="mb-3 col-md-6">
                <label for="account_password" class="form-label">系統密碼</label>
                <input type="password" class="form-control"  name="account_password" id="account_password" value="" autofocus />

                @error('account_password')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              @if(auth('admin')->user()->account_role == 1)
                  
              <div class="mb-3 col-md-6">
                <label for="account_password" class="form-label">系統角色</label>
                
                <select class="form-select" name="account_role" id="account_role">
                  <option value="">請選擇</option>

                  @foreach($role_option as $k => $v)
                  <option value="{{$v->id}}"
                    @if($v->id == $user_role_id)
                    selected
                    @endif
                  >{{$v->role_name}}</option>
                  @endforeach
                </select>

                @error('account_role')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              @endif

              <div class="mb-3 col-md-6">
                <label for="account_realname" class="form-label">真實姓名</label>
                <input type="text" class="form-control"  name="account_realname" id="account_realname" value="{{$account_realname}}" autofocus />

                @error('account_realname')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="account_email" class="form-label">電子信箱</label>
                <input type="email" class="form-control"  name="account_email" id="account_email" value="{{$account_email}}" placeholder="explame@test.com" autofocus />
              
                @error('account_realname')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="account_phone" class="form-label">電話</label>
                <input type="text" class="form-control"  name="account_phone" id="account_phone" value="{{$account_phone}}" autofocus />
              </div>

              <div class="mb-3 col-md-6">
                <label for="account_cellphone" class="form-label">行動電話</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text">TW (+886)</span>
                  <input type="text" class="form-control"  name="account_cellphone" id="account_cellphone" value="{{$account_cellphone}}" autofocus />
                </div>
              </div>

            </div>

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">送出</button>
              <button type="reset" class="btn btn-outline-secondary">重設</button>
            </div>
        </div>
        <!-- 資料輸入form END -->

      </form>

    </div>

  </div>
</div>

@endsection