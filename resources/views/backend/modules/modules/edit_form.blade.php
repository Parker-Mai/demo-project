@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統管理 /</span> 模組管理</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/modules/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-form-label" for="module_display_name">模組名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="module_display_name"  id="module_display_name" value="{{$module_display_name}}" placeholder="模組名稱">
            </div>
            @error('module_display_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          

          <div class="row mb-3">
            <label class="col-form-label" for="module_name">模組應用名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="module_name"  id="module_name" value="{{$module_name}}" placeholder="模組應用名稱"
              @if($action != 'create')
              readonly
              @endif
              >
            </div>
            @error('module_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-form-label" for="category_id">模組分類</label>
            <div class="col-sm-10">
              <select class="form-select" name="category_id" id="category_id">
                <option value="">請選擇</option>
                @foreach($module_categorys as $module_category)
                <option value="{{$module_category['id']}}"
                  @if($module_category_id == $module_category['id'])
                  selected
                  @endif
                >{{$module_category['category_name']}}</option>
                @endforeach
              </select>
            </div>
            @error('module_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-form-label" for="module_name">檔案路徑(系統自動產生)</label>

            <div class="col-sm-10">
              <div class="demo-inline-spacing mt-3">
                <ul class="list-group">
                  <li class="list-group-item d-flex align-items-center">
                    Route路徑：routes/modules/<span id="route_path">{{$module_name_route}}</span>.php
                  </li>
                  <li class="list-group-item d-flex align-items-center">
                    Model路徑：app/Modules/<span id="model_path">{{$module_name_model}}</span>.php
                  </li>
                </ul>
              </div>
            </div>

          </div>

          <div class="row mb-3">
            <label class="col-form-label">權限設定&nbsp;<button class="btn btn-sm btn-outline-primary permission_add" type="button" id="button-addon2">新增</button></label>

            <div class="col-sm-10 permission_row">

              <div class="input-group" style="margin-bottom:5px;">
                <span class="input-group-text">權限名稱 / 權限應用名稱</span>
                <input type="text" class="form-control" name="permission_display_name[]" placeholder="權限名稱" value="列表" readonly>
                <input type="text" class="form-control" name="permission_name[]" placeholder="權限應用名稱(限英文小寫)" value="list" readonly>
                <button class="btn btn-outline-primary" type="button" id="button-addon2" disabled>固定</button>
              </div>

              @foreach($permissions_arr as $display_name => $name)
              <div class="input-group data_row" style="margin-bottom:5px;">
                <span class="input-group-text">權限名稱 / 權限應用名稱</span>
                <input type="text" class="form-control" name="permission_display_name[]" placeholder="權限名稱" value="{{$display_name}}">
                <input type="text" class="form-control" name="permission_name[]" placeholder="權限應用名稱(限英文小寫)" value="{{$name}}">
                <button class="btn btn-outline-primary permission_delete" type="button" id="button-addon2">刪除</button>
              </div>
              @endforeach

            </div>
            
          </div>


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/modules'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

<script type="text/html" id="permission_row_html">

  <div class="input-group data_row" style="margin-bottom:5px;">
    <span class="input-group-text">權限名稱 / 權限應用名稱</span>
    <input type="text" class="form-control" name="permission_display_name[]" placeholder="權限名稱">
    <input type="text" class="form-control" name="permission_name[]" placeholder="權限應用名稱(限英文小寫)">
    <button class="btn btn-outline-primary permission_delete" type="button" id="button-addon2">刪除</button>
  </div>

</script>

<script>

  $(function(){
    $('#module_name').trigger('keyup');
  })

  $('.permission_add').click(function(){
    
    let data_row = $('#permission_row_html').html();

    data_row = data_row.replace("[id]","new_row");
    data_row = data_row.replace("[id]","new_row");

    $('.permission_row').append(data_row);

  })

  $(document).on('click','.permission_delete',function(){
    
    $(this).parents('.data_row').remove();

  })

  $('#module_name').on('keyup keydown',function(){
    
    var val = $(this).val();

    var first_str = val.slice(0,1);
    var other_str = val.slice(1);
    
    //第一個字變大寫
    first_str = first_str.toUpperCase();

    //字串組合
    var all_str = first_str+other_str;

    $('#route_path').html(all_str+"Route");

    $('#model_path').html(all_str);

  })
  
</script>

@endsection