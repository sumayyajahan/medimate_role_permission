<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/app.min.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/custom.css')}}">
    <link rel='shortcut icon' type='image/x-icon' href="{{asset('admin/assets/img/favicon.ico')}}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js"></script>
</head>

<body>
    {{-- <div class="loader"></div> --}}
    @php
    $admin = Auth::user();
    @endphp
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                                  collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        <!-- <li>
                      <form class="form-inline mr-auto">
                          <div class="search-element">
                              <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                              <button class="btn" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                          </div>
                      </form>
                  </li> -->
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('admin/assets/img/user.png')}}"
                                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello </div>
                            <!-- <a href="profile.html" class="dropdown-item has-icon"> <i class="far
                                      fa-user"></i> Profile
                      </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                          Activities -->
                            </a>

                            @if ($admin->role =="Super Admin")

                            <a href="{{route('admin.admins.index')}}" class="dropdown-item has-icon"> <i
                                    class="fas fa-cog"></i>
                                Manage Admin
                            </a>
                            @endif
                            <a href="{{route('admin.change.password')}}" class="dropdown-item has-icon"> <i
                                    class="fas fa-cog"></i>
                                Change Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item has-icon text-danger" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                Logout</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            {{-- <a href="{{route('admin.logout')}}" class="dropdown-item has-icon text-danger"> <i
                                class="fas fa-sign-out-alt"></i>
                            Logout
                            </a> --}}
                        </div>
                    </li>
                </ul>
            </nav>
            @include('includes.admin_sidebar')

            <div class="settingSidebar">
                <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                </a>
                <div class="settingSidebar-body ps-container ps-theme-default">
                    <div class=" fade show active">
                        <div class="setting-panel-header">Setting Panel
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Select Layout</h6>
                            <div class="selectgroup layout-color w-50">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="1"
                                        class="selectgroup-input-radio select-layout" checked>
                                    <span class="selectgroup-button">Light</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="2"
                                        class="selectgroup-input-radio select-layout">
                                    <span class="selectgroup-button">Dark</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Sidebar Color</h6>
                            <div class="selectgroup selectgroup-pills sidebar-color">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1"
                                        class="selectgroup-input select-sidebar">
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                        data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="2"
                                        class="selectgroup-input select-sidebar" checked>
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                        data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Color Theme</h6>
                            <div class="theme-setting-options">
                                <ul class="choose-theme list-unstyled mb-0">
                                    <li title="white" class="active">
                                        <div class="white"></div>
                                    </li>
                                    <li title="cyan">
                                        <div class="cyan"></div>
                                    </li>
                                    <li title="black">
                                        <div class="black"></div>
                                    </li>
                                    <li title="purple">
                                        <div class="purple"></div>
                                    </li>
                                    <li title="orange">
                                        <div class="orange"></div>
                                    </li>
                                    <li title="green">
                                        <div class="green"></div>
                                    </li>
                                    <li title="red">
                                        <div class="red"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                        id="mini_sidebar_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Mini Sidebar</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                        id="sticky_header_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Sticky Header</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                <i class="fas fa-undo"></i> Restore Default
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <section class="section">
                    @include('includes.message')
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> MediMate
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{asset('admin/assets/js/app.min.js')}}"></script>
    <!-- JS Libraies -->
    <script src="{{asset('admin/assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/amcharts4/core.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/amcharts4/charts.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/amcharts4/animated.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/jquery.sparkline.min.js')}}"></script>
    <!-- Page Specific JS File -->
    <script src="{{asset('admin/assets/js/page/index.js')}}"></script>
    <!-- Template JS File -->
    <script src="{{asset('admin/assets/js/scripts.js')}}"></script>
    <!-- Custom JS File -->
    <script src="{{asset('admin/assets/js/custom.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}">
    </script>
    <script src="{{asset('admin/assets/bundles/datatables/export-tables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/export-tables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/export-tables/jszip.min.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/export-tables/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/export-tables/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/assets/bundles/datatables/export-tables/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/page/datatables.js')}}"></script>
    @yield('script')
</body>

</html>
