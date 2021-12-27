<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('login') }}" class="nav-link">خانه</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-comments-o"></i>

                @if (count($unsee) > 0)
                    <span class="badge badge-danger navbar-badge">
                        {{ count($unsee) }}
                    </span>
                @else


                @endif

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                @foreach ($unsee as $alert)
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('master.message.show', $alert->id) }}" class="dropdown-item">
                        <!-- Message Start -->

                        @php
                            $image = 'storage/' . $alert->sender->profile_photo_path;
                        @endphp
                        <div class="media">
                            @if ($alert->sender->profile_photo_path !== null)

                                <img src="{{ asset($image) }}" alt="User Avatar" class="img-size-50 ml-3 img-circle">

                            @endif
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $alert->sender->name }}
                                    <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm">{{ $alert->subject }}</p>
                            </div>
                        </div>

                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach

                <a href="{{ route('master.message.index') }}" class="dropdown-item dropdown-footer">مشاهده همه
                    پیام‌ها</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fa fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
