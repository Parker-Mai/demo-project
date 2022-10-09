
@extends('backend.layouts.main')

@section('content')

<div class="row">
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-3">年訂單金額 (Demo非正式)</h5>
          <div id="totalRevenueChart" class="px-2"></div>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-center">
              <div class="dropdown">
                <button
                  class="btn btn-sm btn-outline-primary dropdown-toggle"
                  type="button"
                  id="growthReportId"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  2022
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                  <a class="dropdown-item" href="javascript:void(0);">2021</a>
                  <a class="dropdown-item" href="javascript:void(0);">2020</a>
                  <a class="dropdown-item" href="javascript:void(0);">2019</a>
                </div>
              </div>
            </div>
          </div>
          <div id="growthChart"></div>
          <div class="text-center fw-semibold pt-3 mb-2">成長 62%</div>

          <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>2022</small>
                <h6 class="mb-0">$32.5k</h6>
              </div>
            </div>
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>2021</small>
                <h6 class="mb-0">$41.2k</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">商品類別銷售量 (Demo非正式)</h5>
          <small class="text-muted">42.82k 銷售總數</small>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">8,258</h2>
            <span>總訂單數</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"
                ><i class='bx bx-cake'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">經典巧克力</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">82.5k</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class='bx bx-cake'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">經典蛋糕</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">23.8k</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-info"><i class='bx bx-cake'></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">彌月蛋糕</h6>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">849k</small>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-4 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">月瀏覽網站人數 (Demo非正式)</h5>
        </div>
      </div>
      <div class="card-body px-0">
        <div class="tab-content p-0">
          <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
            <div class="d-flex p-4 pt-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-primary"
                  ><i class='bx bxs-face' ></i></span>
              </div>
              <div>
                <small class="text-muted d-block">本月總瀏覽網站人數</small>
                <div class="d-flex align-items-center">
                  <h6 class="mb-0 me-1">45960</h6>
                  <small class="text-success fw-semibold">
                    <i class="bx bx-chevron-up"></i>
                    42.9%
                  </small>
                </div>
              </div>
            </div>
            <div id="incomeChart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection