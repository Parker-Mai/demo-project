
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> 文章管理</h4>

<div class="card">

  <div class="card-header">
    <button onclick="location.href='/backend/articles/create_page{{$frame_link_str}}'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button>

    <form action="">
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-search"></i></span>

            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
              網站架構
            </button>
            <div class="mt-3">
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel" aria-hidden="true" style="visibility: hidden;">
                <div class="offcanvas-header">
                  <h5 id="offcanvasEndLabel" class="offcanvas-title">網站架構</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <p class="text-center">
                    選擇完架構後，網頁會自動搜尋該架構的所有文章。
                  </p>
                  <ul class="list-group">
                    @foreach($frame_datas as $data)
          
                    <li class="list-group-item">
          
                      <a href="../backend/articles?frame_id={{$data['id']}}">
                        <div class="form-check-inline">
                          <span class="badge badge-center bg-label-primary">{{$data['id']}}</span>
                          {{$data['frame_display_name']}}
                        </div>
                        
                        @if(count($data->childs))
                          @include('backend.modules.articles.frame_tree',['childs' => $data->childs])
                        @endif
                      </a>
                    </li>
          
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <input type="text" class="form-control" name="keyword" value="{{$keyword}}" placeholder="輸入關鍵字">
            <button class="btn btn-outline-primary" type="submit">搜尋</button>
            @if(!empty($keyword))
              <button class="btn btn-outline-primary" type="button" onclick='location.href="/backend/articles"'>取消搜尋</button>
            @endif
        </div>
      </div>
    </form>
    

  </div>

  

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>
        <tr>
          <th>文章標題</th>
          <th>對應架構</th>
          <th>是否上架</th>
          <th>建檔日期</th>
          <th>更新日期</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($row_datas as $data)

        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$data['data_title']}}</strong></td>
          <td>{{$data['frame_id']}}</td>
          <td>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input is_show_controller" type="checkbox" data-id="{{$data['id']}}"
                @if($data['is_show'])
                  checked
                @endif
              >
            </div>
          </td>
          <td>{{$data['created_at']}}</td>
          <td>{{$data['updated_at']}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/backend/articles/update_page/{{$data['id']}}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                <form action="/backend/articles/delete/{{$data['id']}}" method="POST" class="del_form" data-id="{{$data['id']}}">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="dropdown-item del_btn" data-id="{{$data['id']}}"><i class="bx bx-trash me-1"></i> 刪除</button>
                </form>
              </div>
            </div>
          </td>

        </tr>
        
        @endforeach

      </tbody>

    </table>
  </div>
</div>

{{$datas->links()}}

<hr class="my-5" />

<script type="text/javascript">

  $('.del_btn').click(function(){
    
    if(confirm('確定刪除此項目？')){
      $('.del_form[data-id='+$(this).data('id')+']').submit();
    }else{
      return false;
    }

  })

  $('.is_show_controller').click(function(){
    
    $dataid = $(this).data('id');

    $.ajax({
      url: '/backend/articles/disable',
      type: 'post',
      dataType: 'json',
      data:{
        '_token': '{{ csrf_token() }}',
        'id': $dataid
      },
      success: function(data){
        console.log(data);

        if(data.status != 'YES'){
          alert('系統錯誤!');
        }
      },
      error: function(a){
        console.log(a);
      }
    })

  })

</script>

@endsection