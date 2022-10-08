
@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">資料維護 /</span> 商品管理</h4>

<div class="card">

  <div class="card-header">
    <button onclick="location.href='/backend/products/create_page'" type="button" class="btn btn-primary"><i class="bx bx-plus"></i> 新增</button>

    <button type="button" class="btn btn-primary product_category_model" data-bs-toggle="modal" data-bs-target="#product_category_list">商品分類</button>

    <form action="">
      <div class="card-body demo-vertical-spacing demo-only-element">
        <div class="input-group">
          <span class="input-group-text"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" name="keyword" value="{{$keyword}}">
            <button class="btn btn-outline-primary" type="submit">搜尋</button>
            @if(!empty($keyword) || !empty($tags))
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
          <th>商品圖片</th>
          <th>商品名稱</th>
          <th>庫存數量</th>
          <th>主分類</th>
          <th>分類</th>
          <th>價錢</th>
          <th>是否上架</th>
          <th>是否熱銷商品</th>
          <th>建檔日期</th>
          <th>更新日期</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="table-border-bottom-0">
        @foreach($datas as $data)

        <tr>
          <td>
            <img src="{{$data['product_img'] ? asset('storage/'.$data['product_img']) : asset('assets/img/no_img.jpeg');}}" style="max-width:100px;max-height:100px">
          </td>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$data->product_name}}</strong></td>
          <td>{{$data->product_quantity}}</td>
          <td>
            @switch($data->product_main_category)
              @case(1)
                經典巧克力
                @break
              @case(2)
                經典蛋糕
                @break
              @case(3)
                彌月蛋糕
                @break;
            @endswitch
          </td>
          <td>
            @if(!empty($data['product_category']))
              @foreach($data['product_category'] as $key => $val)
                  <span class="badge bg-label-primary me-1"><a href="/backend/products?tags={{$key}}">{{$val}}</a></span>
              @endforeach
            @endif
          </td>
          <td>{{$data->product_price}}</td>
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
            <div class="form-check form-switch mb-2">
              <input class="form-check-input switch_controller" type="checkbox" data-type="popular" data-id="{{$data['id']}}"
                @if($data['is_popular'])
                  checked
                @endif
              >
            </div>
          </td>
          <td>{{$data->created_at}}</td>
          <td>{{$data->updated_at}}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="/backend/products/update_page/{{$data->id}}"><i class="bx bx-edit-alt me-1"></i> 編輯</a>
                <form action="/backend/products/delete/{{$data->id}}" method="POST" class="del_form" data-id="{{$data->id}}">
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


<!-- 商品分類跳窗-->
<div class="modal fade" id="product_category_list" tabindex="-1" style="display: none;" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">商品分類</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <table class="table product_category_table">

          <thead>
            <tr>
              <th width="50%" style="font-size:16px">分類名稱</th>
              <th width="50%"><button type="button" class="btn btn-sm btn-primary product_category_add_btn"><i class="bx bx-plus"></i> 新增</button></th>
            </tr>
          </thead>
    
          <tbody class="table-border-bottom-0">
            
          </tbody>
    
        </table>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">關閉</button>
      </div>

    </div>
  </div>
</div>

<script type="text/html" id="product_category_html">

  <tr class="data_row" data-id="[id]">
    <td><span class="category_name_str" data-id="[id]">[category_name]</span></td>
    <td>
        <div>
          <button type="button" class="btn btn-sm btn-primary product_category_edit_btn" data-id="[id]">編輯</button>
          <button type="button" class="btn btn-sm btn-primary product_category_save_btn" data-id="[id]">儲存</button>
          <button type="button" class="btn btn-sm btn-primary product_category_del_btn" data-id="[id]">刪除</button>
        </div>
    </td>
  </tr>

</script>

<script type="text/javascript">

  $('.del_btn').click(function(){
    
    if(confirm('確定刪除此項目？')){
      $('.del_form[data-id='+$(this).data('id')+']').submit();
    }else{
      return false;
    }

  })

  $('.product_category_model').click(function(){

    $('.product_category_table').find('.data_row').remove();
    
    $.ajax({
      url: "../backend/product_categorys",
      type: "POST",
      dataType: "json",
      data: {
        "_token": "{{ csrf_token() }}",
      },
      success: function (data) {
          // console.log(data);
          
          for(var i=0;i<data.id.length;i++){

            let data_row = $('#product_category_html').html();

            data_row = data_row.replace('[category_name]',data.category_name[i]);
            data_row = data_row.replace('[id]',data.id[i]);
            data_row = data_row.replace('[id]',data.id[i]);
            data_row = data_row.replace('[id]',data.id[i]);
            data_row = data_row.replace('[id]',data.id[i]);
            data_row = data_row.replace('[id]',data.id[i]);

            $('.product_category_table').find('tbody').append(data_row);
          }

          $('.product_category_save_btn').hide();
          
      },
      error: function (a) {
          console.log(a);
      }

    });
    

  })

  $(document).on('click','.product_category_add_btn',function(){
    
    let data_row = $('#product_category_html').html();

    data_row = data_row.replace("[category_name]","<input type='text' class='form-control' id='input_category_name' value=''>");
    data_row = data_row.replace("[id]","new_row");
    data_row = data_row.replace("[id]","new_row");
    data_row = data_row.replace("[id]","new_row");
    data_row = data_row.replace("[id]","new_row");
    data_row = data_row.replace("[id]","new_row");

    $('.product_category_table').find('tbody').append(data_row);

    $('.product_category_edit_btn[data-id=new_row]').hide();
    $('.product_category_save_btn[data-id=new_row]').show();
  })

  $(document).on('click','.product_category_edit_btn',function(){

    //檢查是否有其他為儲存的input
    var chk = $('.product_category_table').find('input')

    if(chk.length >= 1){
      alert('請先儲存編輯中的項目');
      return false;
    }

    var dataid = $(this).data('id');

    $(this).hide();
    $('.product_category_save_btn[data-id='+dataid+']').show();

    var category_name = $('.category_name_str[data-id='+dataid+']').html();

    $('.category_name_str[data-id='+dataid+']').html("<input type='text' class='form-control' id='input_category_name' value='"+category_name+"'>");

  })

  $(document).on('click','.product_category_save_btn',function(){

    var dataid = $(this).data('id');

    $.ajax({
      url: "../backend/product_categorys/save",
      type: "POST",
      dataType: "json",
      data: {
        "_token": "{{ csrf_token() }}",
        "id": dataid,
        "category_name": $('#input_category_name').val(),
      },
      success: function (data) {
          // console.log(data);
          
          if(data.status == 'YES'){

            $('#input_category_name').remove();
            $('.category_name_str[data-id='+dataid+']').html(data.category_name);

            $('.product_category_save_btn[data-id='+dataid+']').hide();
            $('.product_category_edit_btn[data-id='+dataid+']').show();
          }else{
            alert('資料儲存失敗。');
          }
      },
      error: function (a) {
          console.log(a);
      }

    });

  })

  $(document).on('click','.product_category_del_btn',function(){
    
    if(!confirm("是否刪除該項目？")){
      return false;
    }

    var dataid = $(this).data('id');

    if(dataid == 'new_row'){
      $('.data_row[data-id='+dataid+']').remove();
      return false;
    }

    $.ajax({
      url: "../backend/product_categorys/delete",
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
            alert('資料刪除失敗。');
          }
      },
      error: function (a) {
          console.log(a);
      }

    })

  })

  $('.switch_controller').click(function(){
    
    $dataid = $(this).data('id');

    switch( $(this).data('type')){
      case 'show': var ajax_url = '/backend/products/is_show'; break;
      case 'popular': var ajax_url = '/backend/products/is_popular'; break;
    }

    $.ajax({
      url: ajax_url,
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