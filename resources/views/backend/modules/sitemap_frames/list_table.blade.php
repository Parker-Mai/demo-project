
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> 網站架構</h4>

<div class="card" style="width:80%;margin:auto;">

  <div class="card-header">
    <button onclick="location.href='/backend/sitemap_frames/create_page'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button>
  </div>

  <div class="card-body">

    <div style="width: 80%;margin:auto;">

      <div class="demo-inline-spacing mt-3">

        <ul class="list-group">
          @foreach($datas as $data)

          <li class="list-group-item">

            <div class="form-check-inline">
              <span class="badge badge-center bg-label-primary">{{$data['id']}}</span>
              {{$data['frame_display_name']}}
            </div>
            

            <div class="form-check-inline">
              <a href="/backend/sitemap_frames/update_page/{{$data['id']}}" class="btn btn-sm btn-primary">編輯</a>
            </div>
            
            <div class="form-check form-check-inline form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="is_index_{{$data['id']}}"
              @if($data['is_index'] == 1)
                checked
              @endif
              >
              <label class="form-check-label" for="is_index_{{$data['id']}}">首頁</label>
            </div>

            <div class="form-check form-check-inline form-switch mb-2">
              <input class="form-check-input" type="checkbox" id="is_disabled_{{$data['id']}}"
              @if($data['is_disabled'] == 1)
                checked
              @endif
              >
              <label class="form-check-label" for="is_disabled_{{$data['id']}}">隱藏</label>
            </div>
            
            @if(count($data->childs))
              @include('backend.modules.sitemap_frames.frame_tree',['childs' => $data->childs])
            @endif
      
          </li>

          @endforeach
        </ul>
      </div>

    </div>

  </div>
  

</div>

<hr class="my-5" />

@endsection