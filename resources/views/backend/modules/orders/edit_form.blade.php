@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">資料維護 /</span> 訂單管理</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/orders/{{$action}}" method="POST" enctype="multipart/form-data">

          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">訂單編號</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$order_uid}}" readonly disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">綠界物流交易編號</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$api_trade_uid}}" readonly disabled>
            </div>
          </div>

          

          @if($payment_method == 1)

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="">付款方式</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="7-11取貨付款" readonly disabled>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="">7-11取貨門市</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="131386新竹市東區建中一路52號1樓(建盛門市)" readonly disabled>
              </div>
            </div>
          @else

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">付款方式</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="宅配：黑貓" readonly disabled>
            </div>
          </div>

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="">收件地址</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" value="{{$all_address}}" readonly disabled>
              </div>
            </div>
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">收件人</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$addressee}}" readonly disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">聯絡電話</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$contact_phone}}" readonly disabled>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">訂單總金額</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$order_total}}" readonly disabled>
            </div>
          </div>


          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="">訂單狀態</label>
            <div class="col-sm-10">
              <select class="form-control" name="status" id="stauts" required @if($status == 4) readonly disabled @endif>
                <option value="1" @if($status == 1) selected @endif>訂單處理中</option>
                <option value="2" @if($status == 2) selected @endif>已出貨</option>
                <option value="3" @if($status == 3) selected @endif>訂單完成</option>
                <option value="4" @if($status == 4) selected @endif disabled>已取消</option>
              </select>
            </div>
          </div>


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/orders'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection