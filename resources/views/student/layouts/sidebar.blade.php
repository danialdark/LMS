<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                @if (auth()->user()->profile_photo_path !== null)
                    <div class="image">
                        @php
                            $image = 'storage/' . auth()->user()->profile_photo_path;
                        @endphp
                        <img src="{{ asset($image) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                @endif
                <div class="info">
                    <a href="{{ route('profile.student.me') }}" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview menu-close">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa fa-graduation-cap"></i>
                            <p>
                                بخش کلاس ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('student.class.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>لیست کلاس های من</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-close">
                        <a href="#" class="nav-link active">
                            <i class="fa fa-envelope-o"></i>
                            <p>
                                بخش پیام ها
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('student.message.index') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تمام پیام ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('student.message.sent') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>ارسال شده ها</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('student.message.received') }}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>دریافت شده ها</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item mt-5">
                        <a href="{{ route('login') }}" class="nav-link bg-success active">
                            <i class="nav-icon fa fa-calendar"></i>
                            <p>
                                تقویم
                                <span class="badge badge-info right">۲</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item mt-5">
                        <a href="{{ route('profile.show') }}" class="nav-link bg-danger active">
                            <i class="nav-icon fa fa-lock"></i>
                            <p>
                                تنظیمات امنیتی
                            </p>
                        </a>
                    </li>

                </ul>
                <form action="{{ route('logout') }}" method="Post" class="mt-5">
                    @csrf
                    <button class="btn btn-danger"><i class="nav-icon fa fa-sign-out"></i>خروج
                    </button>
                </form>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
