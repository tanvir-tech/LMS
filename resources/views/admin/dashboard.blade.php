@extends('includes/master')
@section('content')
<div class="container-fluid pt-5">
    <div class="vertical-menu">

        <div data-simplebar="init" class="h-100"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -15px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
    
            <!--- Sidemenu -->
            <div id="sidebar-menu" class="mm-active">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled mm-show" id="side-menu">

                    <li class="menu-title" key="t-apps"> </li>
        
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span key="t-dashboards">New</span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="/admin/createCat" key="t-tui-calendar">Create category</a></li>
                            <li><a href="/admin/createBook" key="t-full-calendar">Add new book</a></li>
                        </ul>
                    </li>
    
                    {{-- <li>
                        <a href="apps-filemanager.html" class="waves-effect">
                            <i class="bx bx-file"></i>
                            <span key="t-file-manager">File Manager</span>
                        </a>
                    </li> --}}
    
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-store"></i>
                            <span key="t-ecommerce">List</span>
                        </a>
                        <ul class="sub-menu mm-collapse" aria-expanded="false">
                            <li><a href="/admin/approvelist" key="t-products">Approval list</a></li>
                            <li><a href="/admin/issuelist" key="t-product-detail">Issue list</a></li>
                            <li><a href="/admin/bookrequestlist" key="t-orders">Book request list</a></li>
                        </ul>
                    </li>
    
    
                </ul>
            </div>
            <!-- Sidebar -->
        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 1398px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 200px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
    </div>



    <div class="container p-5">
        @yield('admin-content')
    </div>
</div>
@endsection
