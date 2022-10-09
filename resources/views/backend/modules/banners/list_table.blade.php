
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">頁面設定 /</span> Banner管理</h4>

<div class="card">

  <div class="card-header">
    <button onclick="location.href='/backend/banners/create_page'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button>

    <form action="">
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" name="keyword" value="{{$keyword}}">
            <button class="btn btn-outline-primary" type="submit">搜尋</button>
            @if(!empty($keyword))
              <button class="btn btn-outline-primary" type="button" onclick='location.href="/backend/banners"'>取消搜尋</button>
            @endif
        </div>
      </div>
    </form>
    

  </div>

  

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>
        <tr>
          <th>標題</th>
          <th>連結</th>
          <th>上下架</th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($datas as $data)

        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$data['title']}}</strong></td>
          <td>{{$data['link']}}</td>
          <td>
            <div class="form-check form-switch mb-2">
              <input class="form-check-input switch_controller" type="checkbox" data-type="show" data-id="{{$data['id']}}"
                @if($data['is_show'])
                  checked
                @endif
              >
            </div>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/backend/banners/update_page/{{$data['id']}}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                <form action="/backend/banners/delete/" method="POST" class="del_form" data-id="{{$data['id']}}">
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

{{-- {{$datas->links()}} --}}

<hr class="my-5" />


<script type="text/javascript">

  $('.del_btn').click(function(){
    
    if(confirm('確定刪除此項目？')){
      $('.del_form[data-id='+$(this).data('id')+']').submit();
    }else{
      return false;
    }

  })

  $('.switch_controller').click(function(){
    
    $dataid = $(this).data('id');

    $.ajax({
      url: '/backend/banners/is_show',
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