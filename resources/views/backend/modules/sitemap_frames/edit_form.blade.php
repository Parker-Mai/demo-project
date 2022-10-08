@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> 網站架構</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/sitemap_frames/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="frame_display_name">架構名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="frame_display_name"  id="frame_display_name" value="{{$frame_display_name}}" placeholder="架構名稱">
            </div>
            @error('frame_display_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="frame_name">架構資料名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="frame_name"  id="frame_name" value="{{$frame_name}}" placeholder="架構資料名稱">
            </div>
            @error('frame_name')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="is_external_link">外部連結</label>
            <div class="col-sm-10">
              <div class="form-check form-check-inline form-switch mt-1">
                <input class="form-check-input" type="checkbox" name="is_external_link" id="is_external_link" value="1" 
                @if($is_external_link)
                checked
                @endif
                >
              </div>
            </div>
          </div>

          
          <div class="row mb-3 link_url">
            <label class="col-sm-2 col-form-label" for="link_url">連結網址</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="link_url"  id="link_url" value="{{$link_url}}" placeholder="連結網址">
            </div>
            @error('link_url')
            <small style="color:red">{{$message}}</small>
            @enderror
          </div>

          <div class="no_link_area">

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="frame_type">畫面類型</label>
              <div class="col-sm-10">
                <div class="input-group input-group-merge">

                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="frame_type" id="frame_type_1" value="1"
                    @if($frame_type == 1)
                    checked
                    @endif
                    >
                    <label class="form-check-label" for="frame_type_1">純內容</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="frame_type" id="frame_type_2" value="2"
                    @if($frame_type == 2)
                    checked
                    @endif
                    >
                    <label class="form-check-label" for="frame_type_2">純列表</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="frame_type" id="frame_type_3" value="3"
                    @if($frame_type == 3)
                    checked
                    @endif
                    >
                    <label class="form-check-label" for="frame_type_3">列表+內容</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="frame_type" id="frame_type_4" value="4"
                    @if($frame_type == 4)
                    checked
                    @endif
                    >
                    <label class="form-check-label" for="frame_type_4">導覽列(無畫面)</label>
                  </div>

                </div>
              </div>
              @error('frame_type')
              <small style="color:red">{{$message}}</small>
              @enderror
            </div>

            <div class="no_view_area">

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="type_list_layout_id">使用佈局(列表)</label>
                <div class="col-sm-10">
                  <select class="form-select" name="type_list_layout_id" id="type_list_layout_id">
                    <option value="">請選擇</option>
                    @foreach($layouts as $layout)
                    <option value="{{$layout['id']}}"
                    @if($type_list_layout_id == $layout['id'])
                      selected
                    @endif
                    >{{$layout['layout_name']}}</option>
                    @endforeach
                  </select>
                </div>
                @error('type_list_layout_id')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="type_content_layout_id">使用佈局(內容)</label>
                <div class="col-sm-10">
                  <select class="form-select" name="type_content_layout_id" id="type_content_layout_id">
                    <option value="">請選擇</option>
                    @foreach($layouts as $layout)
                    <option value="{{$layout['id']}}"
                    @if($type_content_layout_id == $layout['id'])
                      selected
                    @endif
                    >{{$layout['layout_name']}}</option>
                    @endforeach
                  </select>
                </div>
                @error('layout_id')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="use_module_model">模組資料連接</label>
                <div class="col-sm-10">
                  <div class="form-check form-check-inline form-switch mt-1">
                    <input class="form-check-input" type="checkbox" name="use_module_model" id="use_module_model" value="1"
                    @if($use_module_model)
                    checked
                    @endif
                    >
                  </div>
                </div>
              </div>

              <div class="row mb-3 use_module_select">
                <label class="col-sm-2 col-form-label" for="module_id">使用模組</label>
                <div class="col-sm-10">
                  <select class="form-select" name="module_id" id="module_id">
                    <option value="">請選擇</option>
                    @foreach($modules as $module)
                      <option value="{{$module['id']}}"
                      @if($module_id == $module['id'])
                        selected
                      @endif
                      >{{$module['module_display_name']}}</option>
                    @endforeach
                  </select>
                </div>
                @error('module_id')
                <small style="color:red;">{{$message}}</small>
                @enderror
              </div>

              <div class="row mb-3">
                <label class="col-form-label">欄位變數設定</label>
    
                <div class="table-responsive text-nowrap">

                  <table class="table table-bordered">

                    <thead>
                      <tr>
                        <th class="text-center">欄位名稱</th>
                        <th class="text-center">欄位資料名稱</th>
                        <th class="text-center">欄位類型</th>
                        <th class="text-center">欄位選項</th>
                        <th class="text-center"><button class="btn btn-sm btn-primary fields_setting_add" type="button" id="button-addon2">新增</button></th>
                      </tr>
                    </thead>

                    <tbody class="fields_setting_row" >
                      <input type="hidden" name="old_data_counter[]">
                      <input type="hidden" name="new_data_counter[]">

                      @foreach($fields_setting as $field_setting)
                        <tr class="data_row" data-id="{{$field_setting['id']}}">
                          <input type="hidden" name="old_data_counter[]">
                          <td><input type="text" class="form-control" name="field_display_name[old_data][{{$field_setting['id']}}]" value="{{$field_setting['field_display_name']}}"></td>
                          <td><input type="text" class="form-control" name="field_name[old_data][{{$field_setting['id']}}]" value="{{$field_setting['field_name']}}"></td>
                          <td>
                            <select class="form-control" name="field_type[old_data][{{$field_setting['id']}}]">
                              <option value="">請選擇</option>
                                @foreach($field_type_option as $key => $val)
                                  <option value="{{$key}}"
                                    @if($field_setting['field_type'] == $key)
                                      selected
                                    @endif
                                  >{{$val}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td><textarea class="form-control" name="field_option[old_data][{{$field_setting['id']}}]">{{$field_setting['field_option']}}</textarea></td>
                          <td class="text-center"><button class="btn btn-sm btn-primary fields_setting_del" type="button" id="button-addon2" data-type="db" data-id="{{$field_setting['id']}}">刪除</button></td>
                        </tr>
                      @endforeach

                    </tbody>

                  </table>
                </div>
    
                
              </div>
            </div>

          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/sitemap_frames'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

<script type="text/html" id="fields_setting_row_html">

  <tr class="data_row">
    <input type="hidden" name="new_data_counter[]">
    <td><input type="text" class="form-control" name="field_display_name[new_data][]"></td>
    <td><input type="text" class="form-control" name="field_name[new_data][]"></td>
    <td>
      <select class="form-control" name="field_type[new_data][]">
        <option value="">請選擇</option>
        <option value="1">INPUT</option>
        <option value="2">SELECT</option>
        <option value="3">CHECKBOX</option>
        <option value="4">RODIO</option>
        <option value="5">TEXTAREA</option>
        <option value="6">UPLOAD(IMAGE)</option>
        <option value="6">UPLOAD(FILE)</option>
      </select>
    </td>
    <td><textarea class="form-control" name="field_option[new_data][]"></textarea></td>
    <td class="text-center"><button class="btn btn-sm btn-primary fields_setting_del" type="button" id="button-addon2" data-type="html">刪除</button></td>
  </tr>

</script>

<script>

  $(function(){
    
    
    @if($is_external_link)
    $('.link_url').show();
    $('.no_link_area').hide();
    @else
    $('.link_url').hide();
    $('.no_link_area').show();
    @endif
    

    @if($use_module_model)
    $('.use_module_select').show();
    @else
    $('.use_module_select').hide();
    @endif

    @if($frame_type == 4)
    $('.no_view_area').hide();
    @else
    $('.no_view_area').show();
    @endif
  })

  $('#is_external_link').change(function(){
    
    if($(this).is(':checked') == true){
      $('.link_url').show();
      $('.no_link_area').hide();
    }else{
      $('.link_url').hide();
      $('.no_link_area').show();
    }

  })

  $('#use_module_model').change(function(){
    
    if($(this).is(':checked') == true){
      $('.use_module_select').show();
    }else{
      $('.use_module_select').hide();
    }

  })

  $('input[name=frame_type]').click(function(){
    
    if($(this).val() == 4){
      $('.no_view_area').hide();
    }else{
      $('.no_view_area').show();
    }

  })


  $('.fields_setting_add').click(function(){
    
    let data_row = $('#fields_setting_row_html').html();

    $('.fields_setting_row').append(data_row);

  })

  $('.fields_setting_del').click(function(){

    if(confirm("是否確定要刪除？")){

      var type = $(this).data('type');

      var dataid = $(this).data('id');

      if(type == 'db'){
        
        $.ajax({
          url: "../delete_field_setting",
          type: "POST",
          dataType: "json",
          data: {
            "_token": "{{ csrf_token() }}",
            "id": dataid,
          },
          success: function (data) {
              // console.log(data);
              
              if(data.status == 'YES'){
                $('.data_row[data-id='+dataid+']').remove();
              }else{
                alert('資料儲存失敗。');
              }
          },
          error: function (a) {
              console.log(a);
          }

        });

      }else{
        $(this).parents('.data_row').remove();
      }
      
    }

  })
  
</script>

@endsection