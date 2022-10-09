<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>後台管理介面-Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{URL::asset('assets/backend/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{URL::asset('assets/backend/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/backend/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{URL::asset('assets/backend/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{URL::asset('assets/backend/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href="{{URL::asset('assets/backend/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{URL::asset('assets/backend/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{URL::asset('assets/backend/js/config.js')}}"></script>

    <script src="{{URL::asset('assets/backend/js/jquery-3.6.1.min.js')}}"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  </head>

  <body>

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- 左側選單 START -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          
          <div class="app-brand">
            <a href="/backend/index" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{asset('storage/'.$sys_logo)}}">
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

            <!-- Dashboard -->
            <li class="menu-item
              @if($active_category == 'index')
              active
              @endif
            ">
              <a href="/backend/index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">首頁</div>
              </a>
            </li>

            <!-- 功能列 START -->
            
            @foreach($sidebar as $category_name => $module_arr)
            
              @if($category_name != 'no_category')
                <li class="menu-item 
                  @if($category_name == $active_category)
                  active open
                  @endif
                ">

                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-layout"></i>
                    <div data-i18n="{{$category_name}}">{{$category_name}}</div>
                  </a>

                  <ul class="menu-sub">
                    
                    @foreach($module_arr as $module_name => $module_display_name)
                      <li class="menu-item 
                        @if($module_display_name == $active_module)
                        active
                        @endif
                      ">

                        <a href="/backend/{{$module_name}}" class="menu-link">
                          <div data-i18n="{{$module_display_name}}">{{$module_display_name}}</div>
                        </a>

                      </li>
                    @endforeach

                  </ul>

                </li>
              @else

                @foreach($module_arr as $module_name => $module_display_name)
                  <li class="menu-item 
                  @if($module_display_name == $active_module)
                    active open
                    @endif
                  ">
                    <a href="/backend/{{$module_name}}" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-layout"></i>
                      <div data-i18n="{{$module_display_name}}">{{$module_display_name}}</div>
                    </a>
                  </li>
                @endforeach
              @endif
            @endforeach
            
            <!-- 功能列 END -->

          </ul>

        </aside>
        <!-- 左側選單 END -->

        <!-- 右側主內容 START -->
        <div class="layout-page">

          <!-- 上方使用者資訊 -->
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <li class="nav-item lh-1 me-3">
                  <a href="../frontend/index" class="btn btn-outline-dark" target="_blank">前往前台</a>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">

                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar-online">
                      <img src="{{URL::asset('assets/backend/img/default_admin.jpg')}}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>

                  <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar-online">
                              <img src="{{URL::asset('assets/backend/img/default_admin.jpg')}}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{auth('admin')->user()->account_realname}}</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>

                    <li>
                      <a class="dropdown-item" href="/backend/accounts/update_page/{{auth('admin')->user()->id}}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">帳號資料</span>
                      </a>
                    </li>

                    <li>
                      <a class="dropdown-item" href="/backend/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">登出</span>
                      </a>
                    </li>

                  </ul>
                </li>
                <!--/ User -->

                <li class="nav-item navbar-dropdown dropdown-user dropdown">

                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar-online">
                      <box-icon type='solid' name='flag-checkered'></box-icon>
                      {{-- <img src="{{URL::asset('assets/backend/img/default_admin.jpg')}}" alt class="w-px-40 h-auto rounded-circle" /> --}}
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </nav>

          <!-- 中間內容 START -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">

              @if(session()->has('system_message'))
                <div class="bs-toast toast toast-placement-ex m-2 fade bg-info top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">系統通知</div>
                    {{-- <small>11 mins ago</small> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">{{session('system_message')}}</div>
                </div>
              @endif

              @yield('content')
            </div>
          </div> 
          <!-- 中間內容 END -->

          <!-- Footer START -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
              </div>
            </div>
          </footer>
          <!-- Footer END -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- 右側主內容 END -->
      </div>

      <div class="layout-overlay layout-menu-toggle"></div>

    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    {{-- <script src="{{URL::asset('assets/backend/vendor/libs/jquery/jquery.js')}}"></script> --}}
    <script src="{{URL::asset('assets/backend/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{URL::asset('assets/backend/vendor/js/bootstrap.js')}}"></script>
    <script src="{{URL::asset('assets/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{URL::asset('assets/backend/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{URL::asset('assets/backend/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{URL::asset('assets/backend/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{URL::asset('assets/backend/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    
  </body>
</html>