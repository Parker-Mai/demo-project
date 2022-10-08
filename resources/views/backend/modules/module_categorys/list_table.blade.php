
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統功能 /</span> 模組分類</h4>

<div class="card">

  <div class="card-header">
    <button onclick="location.href='/backend/module_categorys/create_page'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button>

    <form action="">
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" name="keyword" value="{{$keyword}}">
            <button class="btn btn-outline-primary" type="submit">搜尋</button>
            @if(!empty($keyword))
              <button class="btn btn-outline-primary" type="button" onclick='location.href="/backend/products"'>取消搜尋</button>
            @endif
        </div>
      </div>
    </form>
    

  </div>

  

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>
        <tr>
          <th>模組分類名稱</th>
          <th>建檔日期</th>
          <th>更新日期</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($datas as $data)

        <tr>
          <td>{{$data->category_name}}</td>
          <td>{{$data->created_at}}</td>
          <td>{{$data->updated_at}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/backend/module_categorys/update_page/{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                <form action="/backend/module_categorys/delete/{{$data->id}}" method="POST" class="del_form" data-id="{{$data->id}}">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="dropdown-item del_btn" data-id="{{$data->id}}"><i class="bx bx-trash me-1"></i> 刪除</button>
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

</script>

@endsection