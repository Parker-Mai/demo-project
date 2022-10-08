@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">資料維護 /</span> 會員管理</h4>

<div class="row">
  <div class="col-md-12">

    <div class="card mb-4">

      <h5 class="card-header">新增</h5>

      <form action="/backend/members/{{$action}}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($action != 'create')
        @method('put')
        @endif

        <!-- 資料輸入form START -->
        <div class="card-body">

            <div class="row">

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">帳號</label>
                <input type="text" class="form-control"  name="member_name" id="member_name" value="{{$member_name}}" autofocus 
                @if($action != 'create')
                  readonly
                @endif
                />

                @error('module_name')
                <small style="color:red">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">密碼</label>
                <input type="password" class="form-control"  name="member_password" id="member_password" autofocus />

                @error('member_password')
                <small style="color:red">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">真實姓名</label>
                <input type="text" class="form-control"  name="member_realname" id="member_realname" value="{{$member_realname}}" autofocus />

                @error('member_realname')
                <small style="color:red">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">性別</label>
                <select class="form-control" name="member_gender" id="member_gender">
                  <option value="">請選擇</option>
                  <option value="1"
                  @if($member_gender == 1) selected @endif
                  >男</option>
                  <option value="2"
                  @if($member_gender == 2) selected @endif
                  >女</option>
                </select>

                @error('member_gender')
                <small style="color:red">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">信箱</label>
                <input type="text" class="form-control"  name="member_email" id="member_email" value="{{$member_email}}" autofocus />

                @error('member_email')
                <small style="color:red">{{$message}}</small>
                @enderror
              </div>

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">聯絡電話</label>
                <input type="text" class="form-control"  name="member_phone" id="member_phone" value="{{$member_phone}}" autofocus />
              </div>

              <div class="mb-3 col-md-6">
                <label for="" class="form-label">出生年月日</label>
                <input type="text" class="form-control"  name="member_birth" id="member_birth" value="{{$member_birth}}" autocomplete="off"/>
              </div>

            </div>
            <div class="row">
              <div class="mb-3 col-md-12 address_data_row">
                <label for="" class="form-label">收件人及收件地址<button class="btn btn-sm btn-outline-primary" id="add_address_btn" type="button">新增</button></label>

                @if(!empty($member_address_counter))
                  @for($i=0;$i<count($member_address_counter);$i++)

                    <div class="input-group data_row" style="margin-bottom:5px;">
                      <input type="hidden" name="member_address_counter[]" value="1">
                      <span class="input-group-text">郵遞區號</span>
                      <input type="text" class="form-control" name="member_addresses[zipcode][]" id="" value="{{$member_addresses['zipcode'][$i]}}">
                      <span class="input-group-text">縣市</span>
                      <input type="text" class="form-control" name="member_addresses[city][]" id="" value="{{$member_addresses['city'][$i]}}">
                      <span class="input-group-text">區域</span>
                      <input type="text" class="form-control" name="member_addresses[area][]" id="" value="{{$member_addresses['area'][$i]}}">
                      <span class="input-group-text">地址</span>
                      <input type="text" class="form-control" name="member_addresses[address][]" id="" value="{{$member_addresses['address'][$i]}}">
                      <span class="input-group-text">收件人</span>
                      <input type="text" class="form-control" name="member_addresses[addressee][]" id="" value="{{$member_addresses['addressee'][$i]}}">
                      <button class="btn btn-outline-primary address_delete" type="button">刪除</button>
                    </div>

                  @endfor
                @endif
              </div>
              
            </div>
            

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">送出</button>
              <button type="button" onclick="location.href='/backend/members'" class="btn btn-primary">返回</button>
            </div>
        </div>
        <!-- 資料輸入form END -->

      </form>

    </div>

  </div>
</div>

<script type="text/html" id="option_html">
  <option value="[option]" [is_selected]>[option]</option>
</script>

<script type="text/html" id="new_address_html">

  <div class="input-group data_row" style="margin-bottom:5px;">
    <input type="hidden" name="member_address_counter[]" value="1">
    <span class="input-group-text">郵遞區號</span>
    <input type="text" class="form-control" name="member_addresses[zipcode][]" id="" value="">
    <span class="input-group-text">縣市</span>
    <input type="text" class="form-control" name="member_addresses[city][]" id="" value="">
    <span class="input-group-text">區域</span>
    <input type="text" class="form-control" name="member_addresses[area][]" id="" value="">
    <span class="input-group-text">地址</span>
    <input type="text" class="form-control" name="member_addresses[address][]" id="" value="">
    <span class="input-group-text">收件人</span>
    <input type="text" class="form-control" name="member_addresses[addressee][]" id="" value="">
    <button class="btn btn-outline-primary address_delete" type="button">刪除</button>
  </div>

</script>

<script>

  $(function(){
    $('#member_birth').datepicker({
      dateFormat:"yy/mm/dd",
      changeMonth: true,
      changeYear: true,
    });
  })

  $('#add_address_btn').click(function(){
    
    let data_row = $('#new_address_html').html();

    $('.address_data_row').append(data_row);    

  })

  $(document).on('click','.address_delete',function(){
    
    $(this).parents('.data_row').remove();

  })

</script>

@endsection