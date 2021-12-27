<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fa">
@include('student.layouts.head')
@yield('headadd')

<body class="hold-transition sidebar-mini">
    <div id="addchat_app" data-baseurl="{{ url('') }}" data-csrfname="{{ 'X-CSRF-Token' }}"
        data-csrftoken="{{ csrf_token() }}"></div>
    <div class="wrapper">
        @include('student.layouts.header')
        @include('student.layouts.sidebar')
        @if (session('success'))
            <section class="d-flex justify-content-center align-item-center">
                <div class="col-md-3">
                    <div class="card bg-success-gradient pr-5">
                        <div class="card-header">
                            <h3 class="card-title">پیام موفقیت</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{ session('success') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </section>
        @endif
        @if (session('danger'))
            <section class="d-flex justify-content-center align-item-center">
                <div class="col-md-3">
                    <div class="card bg-danger-gradient pr-5">
                        <div class="card-header">
                            <h3 class="card-title">پیام اخطار</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="remove"><i
                                        class="fa fa-times"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{ session('danger') }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </section>

        @endif
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('pagetitle')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>

        @include('student.layouts.rightsidebar')

        @include('student.layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @include('student.layouts.scripts')
    @yield('script')
    <script type="module" src="{{ asset('assets/addchat/js/addchat.min.js') }}"></script>
    <!-- Fallback support for Older browsers -->
    <script nomodule src="{{ asset('assets/addchat/js/addchat-legacy.min.js') }}"></script>
</body>


</html>
