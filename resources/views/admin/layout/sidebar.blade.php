<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        {{-- <img src="admin/images/logo/logo.svg" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Admin Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div style="background: white">
                <img src="public/home/image/logo.png"  alt="User Image">
            </div>
            <div class="info">
                <a href="admincp/account/{{Auth::user()->id}}/edit" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a id="dashboard" href="admincp" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admincp/post" class="nav-link">
                        <i class="nav-icon far fa-file-word"></i>
                        <p>
                           Posts
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admincp/banner" class="nav-link">
                        <i class="nav-icon fab fa-elementor"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admincp/account" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Account
                        </p>
                    </a>
                    
                </li>

                <li class="nav-item">
                    <a id="category" href="admincp/category/0/list" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="admincp/typepost" class="nav-link">
                        <i class="nav-icon fas fa-font"></i>
                        <p>
                           Type Posts
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="admincp/social" class="nav-link">
                        <i class="nav-icon fas fa-people-arrows"></i>
                        <p>
                            Social
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope-square"></i>
                      <p>
                        Subscribe Type
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admincp/sub/subsend" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subscribe send</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admincp/sub/subreceive" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subscribe receive</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admincp/sub/subjob" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subscribe job</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $count = DB::table('subscribes')->where('status',0)->count();
                @endphp
                <li class="nav-item">
                    <a href="admincp/subscribe" class="nav-link">
                        <i class="nav-icon far fa-envelope-open"></i>
                        <p>
                            Subscribe
                            <span class="right badge badge-warning">new {{$count}}</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="admincp/standad" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>
                        <p>
                            Stand (sắp xếp AD)
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="admincp/advertisement" class="nav-link">
                        <i class="nav-icon fab fa-adversal"></i>
                        <p>
                            Advertisement
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="admincp/information" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            Information
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope-square"></i>
                      <p>
                        IDOL plus +
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admincp/idolplus/agency" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Agency (công ty quản lý)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admincp/idolplus/group" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Group (nhóm nhạc)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admincp/idolplus/gender" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gender (giới tính)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admincp/idolplus/profession" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profession (Nghề)</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="admincp/idol" class="nav-link">
                        <i class="nav-icon fas fa-info"></i>
                        <p>
                            IDOL
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope-square"></i>
                      <p>
                        KHÁCH HÀNG +
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="admincp/idolclient/client" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>danh sách khách hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admincp/idolclient/idol" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>danh sách vote idol</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>