
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">系統功能 /</span> 系統帳號</h4>

<div class="card">

  <div class="card-header">
    <button onclick="location.href='/backend/accounts/create_page'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button>

    <form action="">
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" name="keyword" value="{{$keyword}}">
            <button class="btn btn-outline-primary" type="submit">搜尋</button>
            @if(!empty($keyword))
              <button class="btn btn-outline-primary" type="button" onclick='location.href="/backend/accounts"'>取消搜尋</button>
            @endif
        </div>
      </div>
    </form>
    

  </div>

  

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>
        <tr>
          <th>系統帳號</th>
          <th>系統名稱</th>
          <th>電子信箱</th>
          <th>電話</th>
          <th>手機</th>
          <th>狀態</th>
          <th>建檔日期</th>
          <th>更新日期</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($datas as $data)

        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$data->account_name}}</strong></td>
          <td>{{$data->account_realname}}</td>
          <td>{{$data->account_email}}</td>
          <td>{{$data->account_phone}}</td>
          <td>{{$data->account_cellphone}}</td>
          <td><button type="button" class="btn btn-sm rounded-pill btn-primary account_disable_btn" data-id="{{$data->id}}">{{$data->account_disabled}}</button></td>
          <td>{{$data->created_at}}</td>
          <td>{{$data->updated_at}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/backend/accounts/update_page/{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                <form action="/backend/accounts/delete/{{$data->id}}" method="POST" class="del_form" data-id="{{$data->id}}">
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

  $('.account_disable_btn').click(function(){

    $dataid = $(this).data('id');

    $.ajax({
      url: '/backend/accounts/disable',
      type: 'post',
      dataType: 'json',
      data:{
        '_token': '{{ csrf_token() }}',
        'id': $dataid
      },
      success: function(data){
        // console.log(data);

        if(data.status == 'YES'){
          $('.account_disable_btn[data-id='+$dataid+']').html(data.val);
        }else{
          
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