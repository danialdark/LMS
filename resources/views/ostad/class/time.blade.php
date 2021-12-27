@extends('ostad.layouts.master')
@section('headadd')
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
    rel="stylesheet" />@endsection
@section('pagetitle')
    اضافه کردن کلاس
@endsection
@section('content')
    <section class="d-flex justify-content-center align-item-center">
        <div class="col-md-3">
            <div class="card bg-warning-gradient pr-5">
                <div class="card-header">
                    <h3 class="card-title">پیام هشدار</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{ 'لطفا در انتخاب زمان کلاس نهایت دقت را داشته باشید زیرا امکان تغیر آن وجود ندارد' }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </section>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('master.class.time.store', $course->id) }}" method="Post">
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
                            <input type="text" id="inputName" value="{{ $course->name }}" disabled class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="time">روز هفته</label>
                            <select class="custom-select" id="time" name="time">
                                <option selected>روزهای هفته</option>
                                <option value="6">شنبه</option>
                                <option value="0">یک شنبه</option>
                                <option value="1">دو شبه</option>
                                <option value="2">سه شنبه</option>
                                <option value="3">چهار شنبه</option>
                                <option value="4">پنج شنبه</option>
                                <option value="5">جمعه</option>
                            </select>
                        </div>

                        <div class="form-group d-flex my-5">
                            <div class="mx-5">
                                <label>ساعت شروع کلاس</label>
                                <input class="timepicker form-control" name="startclock">
                            </div>
                            <div class="mr-5">

                                <label>ساعت پایان کلاس</label>
                                <input class="timepicker form-control" name="endclock">
                            </div>

                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('master') }}" class="btn btn-secondary mr-3">انصراف</a>
            <input type="submit" value="ایجاد روز برای کلاس" class="btn btn-success float-right">
        </div>
    </div>
    </form>

@endsection
@section('script')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script>
        moment.updateLocale('en', {
            week: {
                dow: 1
            } // Monday is the first day of the week
        })
        $('.date').datetimepicker({
            format: 'MM/DD/YYYY',
            locale: 'en',
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right'
            }
        })
        $('.datetime').datetimepicker({
            format: 'MM/DD/YYYY HH:mm:ss',
            locale: 'en',
            sideBySide: true,
            icons: {
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right'
            }
        })
        $('.timepicker').datetimepicker({
            format: 'HH:mm',
            icons: {
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right'
            }
        })
    </script>
@endsection
