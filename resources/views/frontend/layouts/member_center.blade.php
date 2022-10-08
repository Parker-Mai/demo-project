@extends('frontend.layouts.main')

@section('content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">會員中心</h1>
					<ol class="breadcrumb">
						<li><a href="/">首頁</a></li>
						<li class="active">會員中心</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="user-dashboard page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline dashboard-menu text-center">
          <li><a class="active"  href="#">個人資料</a></li>
          <li><a href="/frontend/member-center/cart_list">購物車</a></li>
          <li><a href="/frontend/member-center/order_list">訂單查詢</a></li>
        </ul>

        <!-- 個人資料 START -->
        <div class="dashboard-wrapper dashboard-user-profile">
          <div class="media">

              <div class="media-body">
                <input type="hidden" name="member_id" id="member_id" value="{{$out_data['datas']->id}}">
                <ul class="user-profile-list">
                  <small style="color:red" class="error_db_error"></small>
                  <li><span>帳號:</span>{{$out_data['datas']->member_name}}</li>
                  <li>
                    <div class="front_input_group">
                      <span>信箱:</span>
                      <input type="text" class="form-control" name="member_email" id="member_email" placeholder="信箱" value="{{$out_data['datas']->member_email}}">
                    </div>
                    <small style="color:red" class="error_member_email"></small>
                  </li>
                  <li>
                    <div class="front_input_group">
                      <span>姓名:</span>
                      <input type="text" class="form-control" name="member_realname" id="member_realname" placeholder="姓名" value="{{$out_data['datas']->member_realname}}">
                    </div>
                    <small style="color:red" class="error_member_realname"></small>
                  </li>
                  <li>
                    <div class="front_input_group">
                      <span>性別:</span>
                      <select class="form-control" name="member_gender" id="member_gender">
                        <option value="">請選擇</option>
                        <option value="1" @if($out_data['datas']->member_gender == 1) selected @endif>男</option>
                        <option value="2" @if($out_data['datas']->member_gender == 2) selected @endif>女</option>
                      </select>
                    </div>
                    <small style="color:red" class="error_member_gender"></small>
                  </li>
                  <li>
                    <div class="front_input_group">
                      <span>聯絡電話:</span>
                      <input type="text" class="form-control" name="member_phone" id="member_phone" placeholder="聯絡電話" value="{{$out_data['datas']->member_phone}}">
                    </div>
                    <small style="color:red" class="error_member_phone"></small>
                  </li>
                  <li>
                    <div class="front_input_group">
                      <span>生日:</span>
                      <input type="text" class="form-control" name="member_birth" id="member_birth" placeholder="生日" value="{{$out_data['datas']->member_birth}}" autocomplete="off">
                    </div>
                  </li>
                </ul>
                
              </div>

          </div>
          <div class="text-center" style="width:50%;margin:auto;">
            <button type="button" class="btn btn-main profile_submit">儲存資料</button>
          </div>
        </div>
        <!-- 個人資料 END -->

        <!-- 地址 START -->
        <div class="dashboard-wrapper user-dashboard">
          
          <div class="table-responsive">
            <div style="margin-bottom:10px;">
              <label style="font-size:15px;font-weight: bold">收件地址及收件人</label><button type="button" class="btn btn-default address_add_btn">新增</button>
            </div>
            
            <table class="table address_table">
              <thead>
                <tr>
                  <th>郵遞區號</th>
                  <th>縣市</th>
                  <th>區域</th>
                  <th>地址</th>
                  <th class="col-md-2 col-sm-3">收件人</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                @foreach($out_data['member_addresses'] as $memner_address)
                <tr class="data_row" data-id="{{$memner_address->id}}" data-type="db">
                  <td class="zipcode" data-id="{{$memner_address->id}}">{{$memner_address->zipcode}}</td>
                  <td class="city" data-id="{{$memner_address->id}}">{{$memner_address->city}}</td>
                  <td class="area" data-id="{{$memner_address->id}}">{{$memner_address->area}}</td>
                  <td class="address" data-id="{{$memner_address->id}}">{{$memner_address->address}}</td>
                  <td class="addressee" data-id="{{$memner_address->id}}">{{$memner_address->addressee}}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-default address_modify_btn" data-id="{{$memner_address->id}}">編輯</button>
                      <button type="button" class="btn btn-default address_save_btn" data-id="{{$memner_address->id}}">儲存</button>
                      <button type="button" class="btn btn-default address_delete_btn" data-id="{{$memner_address->id}}"><i class="tf-ion-close" aria-hidden="true"></i></button>
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
        <!-- 地址 END -->
      </div>
    </div>
  </div>
</section>

<script type="text/html" id="option_html">
  <option value="[option]" [is_selected]>[option]</option>
</script>

<script type="text/html" id="new_address_html">

  <tr class="data_row" data-id="new">
    <td class="zipcode" data-id="new"></td>
    <td class="city" data-id="new"></td>
    <td class="area" data-id="new"></td>
    <td class="address" data-id="new">
      <input type="text" class="form-control" name="input_address" id="input_address">
    </td>
    <td class="addressee" data-id="new">
      <input type="text" class="form-control" name="input_addressee" id="input_addressee">
    </td>
    <td>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default address_modify_btn" data-id="new">編輯</button>
        <button type="button" class="btn btn-default address_save_btn" data-id="new">儲存</button>
        <button type="button" class="btn btn-default address_delete_btn" data-id="new"><i class="tf-ion-close" aria-hidden="true"></i></button>
      </div>
    </td>
  </tr>

</script>

<script>

  $(function(){
    $('.address_save_btn').hide();

    $('#member_birth').datepicker({
      dateFormat:"yy/mm/dd",
      changeMonth: true,
      changeYear: true,
    });
  })

  $('.address_add_btn').click(function(){

    var chk = $('.address_table').find('input');

    if(chk.length >= 2){
      alert('請先儲存編輯中的項目');
      return false;
    }

    let new_data_row = $('#new_address_html').html();

    $('.address_table').find('tbody').append(new_data_row);

    make_address_data('new');

    $('.address_modify_btn[data-id=new]').hide();
  })

  $(document).on('click','.address_modify_btn',function(){

    var chk = $('.address_table').find('input');

    if(chk.length >= 2){
      alert('請先儲存編輯中的項目');
      return false;
    }
    
    var dataid = $(this).data('id');
    
    var city = $('.city[data-id='+dataid+']').html();
    var area = $('.area[data-id='+dataid+']').html();
    var address = $('.address[data-id='+dataid+']').html();
    var addressee = $('.addressee[data-id='+dataid+']').html();

    $('.address[data-id='+dataid+']').html("<input type='text' class='form-control' name='input_address' id='input_address' value='"+address+"'>");
    $('.addressee[data-id='+dataid+']').html("<input type='text' class='form-control' name='input_addressee' id='input_addressee' value='"+addressee+"'>");

    make_address_data(dataid,city,area);

    $('.address_modify_btn[data-id='+dataid+']').hide();
    $('.address_save_btn[data-id='+dataid+']').show();

  })

  $(document).on('click','.address_save_btn',function(){
    
    var dataid = $(this).data('id');

    //判斷是否有任一欄位空值
    let chk_array = ['#input_city@縣市','#input_area@區域','#input_address@地址','#input_addressee@收件人'];

    var alert_str = "";
    var trigger_alert = false;

    for(var chk=0;chk<chk_array.length;chk++){
      
      var str_arr = chk_array[chk].split('@');

      console.log($(str_arr[0]).val())
      if($(str_arr[0]).val() == '' || $(str_arr[0]).val() == undefined || $(str_arr[0]).val() == null){
        trigger_alert = true;

        alert_str += str_arr[1] + '不可為空值！\n';
      }

    }

    if(trigger_alert){
      alert(alert_str);
      return false;
    }

    $.ajax({
      url: "/backend/members/save_addresses",
      type: "POST",
      dataType: "json",
      data: {
        "_token": "{{ csrf_token() }}",
        "member_id": $('#member_id').val(),
        "dataid": dataid,
        "input_zipcode": $('.zipcode[data-id='+dataid+']').html(),
        "input_city": $('#input_city').val(),
        "input_area": $('#input_area').val(),
        "input_address": $('#input_address').val(),
        "input_addressee": $('#input_addressee').val(),
      },
      success: function (data) {
          console.log(data);

          if(data.status == 'YES'){
            
            $('.zipcode[data-id='+dataid+']').html(data.out_data['zipcode']);
            $('.city[data-id='+dataid+']').html(data.out_data['city']);
            $('.area[data-id='+dataid+']').html(data.out_data['area']);
            $('.address[data-id='+dataid+']').html(data.out_data['address']);
            $('.addressee[data-id='+dataid+']').html(data.out_data['addressee']);

            $('.address_modify_btn[data-id='+dataid+']').show();
            $('.address_save_btn[data-id='+dataid+']').hide();

            $('.zipcode[data-id='+dataid+']').attr('data-id',data.out_data['id']);
            $('.city[data-id='+dataid+']').attr('data-id',data.out_data['id']);
            $('.area[data-id='+dataid+']').attr('data-id',data.out_data['id']);
            $('.address[data-id='+dataid+']').attr('data-id',data.out_data['id']);
            $('.addressee[data-id='+dataid+']').attr('data-id',data.out_data['id']);
            $('.address_modify_btn[data-id='+dataid+']').attr('data-id',data.out_data['id']);
            $('.address_save_btn[data-id='+dataid+']').attr('data-id',data.out_data['id']);
          }
      },
      error: function (a) {
          console.log(a);
      }

    });

  })

  $(document).on('click','.address_delete_btn',function(){
    
    if(!confirm("確定要刪除此項目？")){
      return false;
    }

    var dataid = $(this).data('id');

    $.ajax({
      url: "/backend/members/delete_addresses",
      type: "POST",
      dataType: "json",
      data: {
        "_token": "{{ csrf_token() }}",
        "dataid": dataid,
      },
      success: function (data) {
          console.log(data);

          if(data.status == 'YES'){
            $('.address_table').find('.data_row[data-id='+dataid+']').remove();
          }else{
            alert('資料刪除失敗，請聯絡工程師');
          }
      },
      error: function (a) {
          console.log(a);
      }

    });

  })
  
  $(document).on('change','#input_city',function(){

    $('#input_area').find('option').remove();

    var dataid = $(this).data('id');

    var city = $('#input_city').val();
    var area = $('#input_area').val();
    make_address_data(dataid,city,area);
  })

  $(document).on('change','#input_area',function(){
    var dataid = $(this).data('id');

    var city = $('#input_city').val();
    var area = $('#input_area').val();
    make_address_data(dataid,city,area);
  })

  function make_address_data(dataid='',city='',area=''){
    
    $.ajax({
      url: "/backend/members/make_address_data",
      type: "POST",
      dataType: "json",
      data: {
        "_token": "{{ csrf_token() }}",
        "city": city,
        "area": area,
      },
      success: function (data) {
          console.log(data);

          let all_city_option ="";
          let all_area_option ="";

          for(var i=0;i<data.all_city.length;i++){

            let option_row = $('#option_html').html();

            option_row = option_row.replace('[option]',data.all_city[i]);
            option_row = option_row.replace('[option]',data.all_city[i]);

            if(city == data.all_city[i]){
              option_row = option_row.replace('[is_selected]','selected');
            }

            all_city_option += option_row;
          }

          if(data.all_area.length > 0){
            
            for(var j=0;j<data.all_area.length;j++){
              let option_row = $('#option_html').html();

              option_row = option_row.replace('[option]',data.all_area[j]);
              option_row = option_row.replace('[option]',data.all_area[j]);

              if(area == data.all_area[j]){
                option_row = option_row.replace('[is_selected]','selected');
              }

              all_area_option += option_row;
            }

          }

          let return_city_select = "<select class='form-control' name='input_city' id='input_city' data-id='"+dataid+"'><option value=''>請選擇</option>"+all_city_option+"</select>";

          let return_area_select = "<select class='form-control' name='input_area' id='input_area' data-id='"+dataid+"'><option value=''>請選擇</option>"+all_area_option+"</select>";


          $('.city[data-id='+dataid+']').html(return_city_select);
          $('.area[data-id='+dataid+']').html(return_area_select);
          $('.zipcode[data-id='+dataid+']').html(data.zipcode);
          
          
      },
      error: function (a) {
          console.log(a);
      }

    });

  }


  $('.profile_submit').click(function(){

    $.ajax({
      url: "/backend/members/member_update_data",
      type: "POST",
      dataType: "json",
      data: {
        "_token": "{{ csrf_token() }}",
        "member_id": $('#member_id').val(),
        "member_email": $('#member_email').val(),
        "member_realname": $('#member_realname').val(),
        "member_gender": $('#member_gender').val(),
        "member_phone": $('#member_phone').val(),
        "member_birth": $('#member_birth').val(),
      },
      success: function (data) {
          console.log(data);

          if(data.status != 'YES'){
            
            for(var e=0;e<data.message.length;e++){

              var msg_arr = data.message[e].split('@#');

              var field_name = msg_arr[0];
              var error_msg = msg_arr[1];

              $('.error_'+msg_arr[0]).html(msg_arr[1]);

            }

          }else{
            alert('儲存成功');
          }
      },
      error: function (a) {
          console.log(a);
      }

    });

  })

  
  

</script>

@endsection
