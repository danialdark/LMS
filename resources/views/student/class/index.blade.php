@extends('student.layouts.master')
@section('pagetitle')
    مشاهده کلاس ها
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">مشخصات کلاس های شما</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="text-center">
                                <th>شماره</th>
                                <th>نام کلاس</th>
                                <th>نام استاد</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>تنظیمات کلاس</th>
                            </tr>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($courses as $course)
                                <tr class="text-center">
                                    <td>{{ $number }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ count($course->users) }}</td>
                                    <td>@php
                                        $starttime = $course->start_date;
                                        $startyear = intval(substr($starttime, 0, 4));
                                        $startmonth = intval(substr($starttime, 5, 7));
                                        $startday = intval(substr($starttime, 8, 11));
                                        $starttimearray = Verta::getJalali($startyear, $startmonth, $startday);
                                        $finalstartdate = $starttimearray[0] . '-' . $starttimearray[1] . '-' . $starttimearray[2];
                                        echo $finalstartdate;
                                    @endphp</td>
                                    <td>@php
                                        $endtime = $course->end_date;
                                        $endyear = intval(substr($endtime, 0, 4));
                                        $endmonth = intval(substr($endtime, 5, 7));
                                        $endday = intval(substr($endtime, 8, 11));
                                        $endtimearray = Verta::getJalali($endyear, $endmonth, $endday);
                                        $finalenddate = $endtimearray[0] . '-' . $endtimearray[1] . '-' . $endtimearray[2];
                                        echo $finalenddate;
                                    @endphp</td>
                                    <td class="d-flex justify-content-center">
                                        {{-- link for entering the class --}}
                                        @php
                                            $now = now('Asia/Tehran');
                                            $courseendtime = now()->create($course->end_date);
                                            $coursedays = [];
                                            foreach ($course->informations as $information) {
                                                array_push($coursedays, $information->day_name);
                                            }
                                        @endphp
                                        @if ($courseendtime->greaterThanOrEqualTo($now))
                                            @foreach ($course->informations as $information)
                                                @php
                                                    $start_time = now()->create($information->start_time, 'Asia/Tehran');
                                                    $end_time = now()->create($information->end_time, 'Asia/Tehran');
                                                @endphp
                                                @if ($now->dayOfWeek == $information->day_name)
                                                    @if ($start_time < $now && $now < $end_time)
                                                        <a class="btn btn-warning ml-2"
                                                            href="{{ $course->student_link }}">ورود به
                                                            کلاس</a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        {{-- link for entering the class --}}
                                        <a class=" btn btn-primary ml-2"
                                            href="{{ route('student.upload.index', $course->id) }}">فایل ها</a>
                                        <div class="btn-group">

                                            <button type="button" class="btn btn-info btn-flat">مشخصات</button>
                                            <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" x-placement="top-start"
                                                style="position: absolute; transform: translate3d(0px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a type="button" class="btn btn-primary dropdown-item" data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $course->id }}">
                                                    مشاهده مشخصات کلاس
                                                </a>
                                                <a href="{{ route('student.video.index', $course->id) }}"
                                                    class="btn btn-primary dropdown-item">
                                                    مشاهده لیست جلسات ظبط شده
                                                </a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                {{-- class information modal --}}
                                <div class="modal fade" id="exampleModalCenter{{ $course->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">مشخصات کلاس</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                نام کلاس:{{ $course->name }}
                                                <br>
                                                روز های برگزاری:

                                                @php
                                                    $num = 1;
                                                @endphp
                                                @foreach ($course->informations as $information)

                                                    @if ($information->day_name == 6)
                                                        <strong>شنبه ها</strong>

                                                    @elseif($information->day_name==0)
                                                        <strong>یک شنبه ها</strong>

                                                    @elseif($information->day_name==1)
                                                        <strong> دوشنبه ها</strong>

                                                    @elseif($information->day_name==2)
                                                        <strong>سه شنبه ها </strong>

                                                    @elseif($information->day_name==3)
                                                        <strong>چهار شنبه ها</strong>

                                                    @elseif($information->day_name==4)
                                                        <strong>پنج شنبه ها</strong>

                                                    @elseif($information->day_name==5)
                                                        <strong>جمعه ها</strong>

                                                    @endif
                                                    {{ 'ساعت ' }} {{ $information->start_time }}
                                                    {{ 'تا' }} {{ $information->end_time }}
                                                    @if ($num < count($course->informations))
                                                        {{ 'و' }}
                                                    @endif
                                                    @php
                                                        $num++;
                                                    @endphp

                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">نگاه
                                                    کردم</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end class information modal --}}
                                {{-- class information modal --}}
                                @php
                                    $number++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
