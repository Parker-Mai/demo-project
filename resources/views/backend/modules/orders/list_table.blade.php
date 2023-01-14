
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">資料維護 /</span> 訂單管理</h4>

<div class="card">

  <div class="card-header">
    {{-- <button onclick="location.href='/backend/orders/create_page'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button> --}}

    <form action="">
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" name="keyword" value="{{$keyword}}">
            <button class="btn btn-outline-primary" type="submit">搜尋</button>
            @if(!empty($keyword))
              <button class="btn btn-outline-primary" type="button" onclick='location.href="/backend/orders"'>取消搜尋</button>
            @endif
        </div>
      </div>
    </form>
    

  </div>

  

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>
        <tr>
          <th>訂單編號</th>
          <th>付款方式</th>
          <th>訂單金額</th>
          <th>訂單狀態</th>
          <th>建檔日期</th>
          <th>更新日期</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($datas as $data)

        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$data->order_uid}}</strong></td>
          <td>
            @if($data->payment_method == 1)
              7-11取貨付款
            @elseif($data->payment_method == 2)
              宅配：黑貓
            @elseif($data->payment_method == 3)
              信用卡/金融卡付款
            @endif
          </td>
          <td>{{$data->order_total}}</td>
          <td>
            <span class="badge bg-label-primary me-1">
              @switch($data->status)
                @case(1)
                  訂單處理中
                  @break;
                @case(2)
                  已出貨
                  @break;
                @case(3)
                  訂單完成
                  @break;
                @case(4)
                  已取消
                  @break;
              @endswitch
            </span>
          </td>
          <td>{{$data->created_at}}</td>
          <td>{{$data->updated_at}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/backend/orders/update_page/{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                <form action="/backend/orders/delete/{{$data->id}}" method="POST" class="del_form" data-id="{{$data->id}}">
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