@extends('ostad.layouts.master')
@section('headadd')
    <link rel="stylesheet" href="{{ asset('panel/datepicker/css/lib/persian-datepicker.min.css') }}">
@endsection
@section('pagetitle')
    اضافه کردن کلاس
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('master.class.store') }}" method="Post">
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">اطلاعات کلی کلاس</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">نام کلاس</label>
                            <input type="text" id="inputName" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="student_link">لینک ورود به کلاس برای دانشجو</label>
                            <input type="text" id="student_link" name="student_link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="master_link">لینک ورود به کلاس برای شما</label>
                            <input type="text" id="master_link" name="master_link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany"> تاریخ شروع کلاس</label>
                            <input type="text" id="persianDatapicker" name="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputProjectLeader">تاریخ پایان کلاس</label>
                            <input type="text" id="persianDatapickers" name="end_date" class="form-control">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('master') }}" class="btn btn-secondary">انصراف</a>
            <input type="submit" value="ساخت کلاس جدید" class="btn btn-success float-right">
        </div>
    </div>
    <p> ava  </p>
    </form>

@endsection
@section('script')
    {{-- <script src={{ asset('panel/datepicker/js/lib/jquery-3.2.1.min.js') }}></script>

    <script src={{ asset('panel/plugins/jquery/jquery.min.js') }}></script> --}}
    <!-- Bootstrap 4 -->
    {{-- <script src={{ asset('panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('panel/dist/js/adminlte.min.js') }}></script> --}}
    <!-- AdminLTE for demo purposes -->
    <script src={{ asset('panel/dist/js/demo.js') }}></script>
    <script src={{ asset('panel/datepicker/js/lib/persian-date.min.js') }}></script>
    <script src={{ asset('panel/datepicker/js/lib/persian-datepicker.min.js') }}></script>
    <script src={{ asset('panel/datepicker/js/app.js') }}></script>
@endsection
