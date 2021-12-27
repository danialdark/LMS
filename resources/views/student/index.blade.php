@extends('student.layouts.master')
@section('pagetitle')
    داشبورد
@endsection
@section('headadd')
    <link rel="stylesheet" href="{{ asset('panel/datepicker/css/lib/persian-datepicker.min.css') }}">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
@endsection
@section('content')
    {{-- after cards --}}
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            {{-- incoming class list --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> کلاس های امروز</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0" style="display: block;">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($incomingclasses as $incomingclasse)
                            @foreach ($incomingclasse->informations as $information)
                                @php
                                    $nowtime = now('Asia/Tehran');
                                    $start_time = now()->create($information->start_time, 'Asia/Tehran');
                                    $end_time = now()->create($information->end_time, 'Asia/Tehran');
                                @endphp
                                @if ($nowtime->dayOfWeek == $information->day_name)
                                    <li class="item">
                                        <div class="product-info">
                                            <p class="product-title">کلاس
                                                {{ $incomingclasse->name }}
                                                <span
                                                    class="badge badge-danger float-left mr-2">{{ $information->end_time }}</span>
                                                <span
                                                    class="badge badge-success float-left">{{ $information->start_time }}</span>

                                            </p>
                                            <div class="mr-5">
                                                @if ($start_time < $nowtime && $nowtime < $end_time)
                                                    <a href="{{ $incomingclasse->student_link }}"
                                                        class="btn btn-sm btn-block btn-outline-success">ورود به کلاس</a>

                                                @elseif($start_time < $nowtime && $nowtime> $end_time)
                                                        <a href="#" class="btn btn-sm btn-danger">کلاس تمام شده</a>
                                                    @else <a href="#" class="btn btn-sm btn-info">زمان شروع فرا
                                                            نرسیده</a>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center" style="display: block;">
                    <a href="#" class="uppercase">نمایش همه کلاس ها</a>
                </div>
                <!-- /.card-footer -->
            </div>
            {{-- incoming class list --}}
            {{-- to do list --}}
            <div class="card">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        لیست رویداد های پیش رو
                    </h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm">
                            <li class="page-item"><a href="#" class="page-link">«</a></li>
                            <li class="page-item"><a href="#" class="page-link">۱</a></li>
                            <li class="page-item"><a href="#" class="page-link">۲</a></li>
                            <li class="page-item"><a href="#" class="page-link">۳</a></li>
                            <li class="page-item"><a href="#" class="page-link">»</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list ui-sortable">
                        @foreach ($tasks as $task)
                            @php
                                $now = now();
                                $tasktime = now()->create($task->date);
                            @endphp
                            @if ($tasktime->greaterThanOrEqualTo($now))
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle ui-sortable-handle">
                                        <i class="fa fa-ellipsis-v"></i>
                                        <i class="fa fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->

                                    <!-- todo text -->
                                    <span class="text">{{ $task->name }}</span>
                                    <!-- Emphasis label -->
                                    <small class="badge badge-danger"><i class="fa fa-clock-o"></i>
                                        {{ $tasktime->diffInHours(now()) }}
                                    </small>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools d-flex">
                                        <a href=""></a>
                                        {{-- <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#edit{{ $task->id }}"
                                            style="height:1px; border-color:transparent;">
                                            <i class="fa fa-edit"></i>
                                        </button> --}}
                                        <form action="{{ route('student.task.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-outline-danger "
                                                style="height:1px; border-color:transparent;">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> جدید
                    </button>
                    {{-- modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ساخت رویداد جدید</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('student.task.store') }}" method="Post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="name">عنوان</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputClientCompany"> تاریخ </label>
                                            <input type="text" id="persianDatapicker" name="date" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>ساعت رویداد</label>
                                            <input class="timepicker form-control" name="time">
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">پشیمون
                                        شدم</button>
                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- end of model --}}


                </div>
            </div>
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
            <div class="card bg-success-calender">
                <div class="card-header no-border ui-sortable-handle" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-calendar"></i>
                        تقویم
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                        <!-- button with a dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn  btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bars"></i></button>
                            <div class="dropdown-menu float-right" role="menu">
                                <a href="#" class="dropdown-item">رویداد تازه</a>
                                <a href="#" class="dropdown-item">حذف رویدادها</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">نمایش تقویم</a>
                            </div>
                        </div>
                        <button type="button" class="btn  btn-sm" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn  btn-sm" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0" style="display: block;">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
        <!-- right col -->
    </div>
@endsection
@section('script')
    <script src={{ asset('panel/dist/js/demo.js') }}></script>
    <script src={{ asset('panel/datepicker/js/lib/persian-date.min.js') }}></script>
    <script src={{ asset('panel/datepicker/js/lib/persian-datepicker.min.js') }}></script>
    <script src={{ asset('panel/datepicker/js/app.js') }}></script>
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
