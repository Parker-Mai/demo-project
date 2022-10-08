@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> 文章管理</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/articles/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">

            <label class="col-sm-2 col-form-label" for="data_title">
              <button class="btn btn-primary btn-xs" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">網站架構</button>
            </label>

            <div class="col-sm-10">
              <input type="text" class="form-control" name="frame_name"  id="frame_name" value="{{$frame_name}}" readonly>
              <input type="hidden" class="form-control" name="frame_id" id="frame_id" value="{{$frame_id}}">
            </div>
            @error('frame_id')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>

          <div class="mt-3">
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel" aria-hidden="true" style="visibility: hidden;">
              <div class="offcanvas-header">
                <h5 id="offcanvasEndLabel" class="offcanvas-title">網站架構</h5>
                <button type="button" class="btn-close text-reset close_offcanvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">

                <ul class="list-group">
                  @foreach($frame_datas as $data)
        
                  <li class="list-group-item">

                    <a href="../articles/create_page?frame_id={{$data['id']}}">
                      <div class="form-check-inline">
                        <span class="badge badge-center bg-label-primary">{{$data['id']}}</span>
                        {{$data['frame_display_name']}}

                        @if($data['frame_type'] != 4 && $data['is_index'] == 0)
                        <button type="button" class="btn btn-xs btn-primary">帶入</button>
                        @endif
                      </div>
                    </a>

                    @if(count($data->childs))
                      @include('backend.modules.articles.frame_tree_edit',['childs' => $data->childs])
                    @endif
                  </li>
        
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="data_title">資料標題</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="data_title"  id="data_title" value="{{$data_title}}" placeholder="資料標題">
            </div>
            @error('data_title')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>

          <hr class="my-5" />

          <!-- 自訂欄位 START -->
          <input type="hidden" name="field_setting[flag]">
          @foreach($frame_fields_setting as $frame_field_setting)

            <div class="row mb-3">

              <label class="col-sm-2 col-form-label" for="{{$frame_field_setting['field_name']}}">{{$frame_field_setting['field_display_name']}}</label>

              <div class="col-sm-10">
                @switch($frame_field_setting['field_type'])

                  @case (1)
                    <input type="text" class="form-control" name="field_setting[{{$frame_field_setting['id']}}]"  id="{{$frame_field_setting['field_name']}}" value="{{$field_setting[$frame_field_setting['id']]}}" placeholder="{{$frame_field_setting['field_display_name']}}">
                    @break;
                  @case (2)
                    <select class="form-control" name="field_setting[{{$frame_field_setting['id']}}]" id="{{$frame_field_setting['field_name']}}">
                      <option value="">請選擇</option>
                      @foreach($frame_field_setting['field_option'] as $field_option)
                      <option value="{{$field_option}}"
                        @if($field_setting[$frame_field_setting['id']] == $field_option)
                          selected
                        @endif
                      >{{$field_option}}</option>
                      @endforeach
                    </select>
                    @break;
                  @case (3)
                      <input type="hidden" name="field_setting[{{$frame_field_setting['id']}}][]">
                      @foreach($frame_field_setting['field_option'] as $key => $field_option)
                      <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="field_setting[{{$frame_field_setting['id']}}][]" id="{{$frame_field_setting['field_name']}}_{{$key}}" value="{{$field_option}}"
                          @if(in_array($field_option,$field_setting[$frame_field_setting['id']]))
                            checked
                          @endif
                        >
                        <label class="form-check-label" for="{{$frame_field_setting['field_name']}}_{{$key}}">{{$field_option}}</label>
                      </div>
                      @endforeach
                    @break;
                  @case (4)
                    <input type="hidden" name="field_setting[{{$frame_field_setting['id']}}]">
                      @foreach($frame_field_setting['field_option'] as $key => $field_option)
                      <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="field_setting[{{$frame_field_setting['id']}}]" id="{{$frame_field_setting['field_name']}}_{{$key}}" value="{{$field_option}}"
                          @if($field_setting[$frame_field_setting['id']] == $field_option)
                            checked
                          @endif
                        >
                        <label class="form-check-label" for="{{$frame_field_setting['field_name']}}_{{$key}}">{{$field_option}}</label>
                      </div>
                      @endforeach
                    @break;
                  @case (5)
                    <textarea class="form-control" name="field_setting[{{$frame_field_setting['id']}}]">{{$field_setting[$frame_field_setting['id']]}}</textarea>
                    @break;
                  
                  @case(6)
                    <input class="form-control" type="file" name="field_setting[{{$frame_field_setting['id']}}]" accept=".jpg, .jpeg, .png">
                      @if(!empty($field_setting[$frame_field_setting['id']]))
                        <img src="{{asset('storage/'.$field_setting[$frame_field_setting['id']].'')}}" style="max-width:150px;max-height:150px">
                      @endif
                    @break;

                  @case(7)
                    <input class="form-control" type="file" name="field_setting[{{$frame_field_setting['id']}}]" accept=".docx, .pptx, .xlsx, .pdf">
                    @if(!empty($field_setting[$frame_field_setting['id']]))
                      <a href="{{asset('storage/'.$field_setting[$frame_field_setting['id']].'')}}">檔案下載</a>
                    @endif
                    @break;
                @endswitch
                
              </div>

            </div>

            

          @endforeach

          <!-- 自訂欄位 END -->

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/articles'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection