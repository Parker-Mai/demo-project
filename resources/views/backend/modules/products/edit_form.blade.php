@extends('backend.layouts.main')

@section('content')

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">資料維護 /</span> 商品管理</h4>

<div class="row">
  
  <div class="col-xxl">
    <div class="card mb-4">

      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">新增</h5>
      </div>

      <div class="card-body">

        <form action="/backend/products/{{$action}}" method="POST" enctype="multipart/form-data">
          @csrf

          @if($action != 'create')
            @method('PUT')
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_name">商品名稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="product_name"  id="product_name" value="{{$product_name}}" placeholder="商品名稱">
            </div>
            @error('product_name')
            <small style="color:red;">{{$message}}</small>
            @enderror
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_main_category">商品主分類</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <select class="form-control" name="product_main_category" id="product_main_category">
                  <option value="">請選擇</option>
                  @foreach($product_main_category_option as $key => $value)
                    <option value="{{$key}}"
                      @if($product_main_category == $key)
                        selected
                      @endif
                    >{{$value}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_category">商品分類</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">

                  @foreach($product_category_option as $id => $val)

                      <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" name="product_category[]" id="product_category_{{$id}}" value="{{$id}}" 
                        @if(in_array($val,$product_category))
                          checked
                        @endif
                        >
                        <label class="form-check-label" for="product_category_{{$id}}">{{$val}}</label>
                      </div>

                  @endforeach
              </div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_quantity">商品數量</label>
            <div class="col-sm-10">
              <input type="number" min="0" class="form-control" name="product_quantity" id="product_quantity" value="{{$product_quantity}}" placeholder="商品數量">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_price">商品價錢</label>
            <div class="col-sm-10">
              <input type="number" min="0" class="form-control" name="product_price" id="product_price" value="{{$product_price}}" placeholder="商品價錢">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_img">商品圖片</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="product_img" id="product_img">
            </div>
          </div>

          @if(!empty($product_img))
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
              <img src="{{asset('storage/'.$product_img)}}" style="max-width:150px;max-height:150px">
            </div>
          </div>
          @endif

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_description">商品描述</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="product_description" id="product_description" placeholder="商品描述">{{$product_description}}</textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_content">商品內容</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="product_content" id="product_content" placeholder="商品內容">{{$product_content}}</textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="product_specification">商品規格</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="product_specification" id="product_specification" placeholder="商品規格">{{$product_specification}}</textarea>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">送出</button>
              <button type="button" onclick="location.href='/backend/products'" class="btn btn-primary">返回</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

</div>

@endsection