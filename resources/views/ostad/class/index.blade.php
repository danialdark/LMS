@extends('ostad.layouts.master')
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
                                <th>تعداد دانشجو</th>
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
                                                            href="https://pafcoerp.com/VCUI/Operation/Default.pc">ورود به
                                                            کلاس</a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        {{-- link for entering the class --}}
                                        <a class=" btn btn-primary ml-2"
                                            href="{{ route('master.upload.index', $course->id) }}">فایل ها</a>
                                        <div class="btn-group">

                                            <button type="button" class="btn btn-info btn-flat">مشخصات</button>
                                            <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" x-placement="top-start"
                                                style="position: absolute; transform: translate3d(0px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item"
                                                    href="{{ route('master.class.time.create', $course->id) }}">ایجاد زمان
                                                    برگزاری برای
                                                    کلاس</a>
                                                <a type="button" class="btn btn-primary dropdown-item" data-toggle="modal"
                                                    data-target="#exampleModalCenter{{ $course->id }}">
                                                    مشاهده مشخصات کلاس
                                                </a>
                                                <a type="button" class="btn btn-primary dropdown-item" data-toggle="modal"
                                                    data-target="#studentlist{{ $course->id }}">
                                                    مشاهده لیست دانشجو ها
                                                </a>
                                            </div>
                                        </div>

                                        <div class="btn-group mx-2">
                                            <button type="button" class="btn btn-danger btn-flat">امکانات</button>
                                            <button type="button" class="btn btn-danger btn-flat dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" x-placement="top-start"
                                                style="position: absolute; transform: translate3d(0px, -165px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a type="button" class="btn btn-primary dropdown-item" data-toggle="modal"
                                                    data-target="#session{{ $course->id }}">
                                                    ایجاد جلسه
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('master.class.edit', $course->id) }}">ویرایش</a>
                                                <form action="{{ route('master.class.destroy', $course->id) }}"
                                                    method="Post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="dropdown-item">حذف</button>
                                                </form>
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

                                {{-- class student list modal --}}
                                <div class="modal fade" id="studentlist{{ $course->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">لیست دانشجو ها</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <ul class="list-group list-group-flush">
                                                    @foreach ($course->users as $user)
                                                        @if ($user->profile_photo_path !== null)
                                                            @php
                                                                $image = 'storage/' . $user->profile_photo_path;
                                                            @endphp
                                                        @endif
                                                        <li class="list-group-item">
                                                            @if (isset($image))
                                                                <img class="direct-chat-img" src="{{ asset($image) }}"
                                                                    alt="message user image">
                                                            @endif
                                                            <a href="{{ route('prof.show', $user->id) }}"
                                                                class="text-dark">{{ $user->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">نگاه
                                                    کردم</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end class student list modal --}}

                                {{-- class session file modal --}}
                                <div class="modal fade" id="session{{ $course->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ex">ایجاد جلسه</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('master.video.store') }}" method="POST">
                                                    @csrf
                                                    <label for="videon">نام ویدیو</label>
                                                    <input class="form-control" id="videon" type="text" name="video_name">
                                                    <label class="mt-2" for="video">لینک ویدیو</label>
                                                    <input class="form-control mt-2" id="video" type="text"
                                                        name="video_path">
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <button type="submit" class="btn btn-primary mt-2">ذخیره</button>
                                                </form>

                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end class  session file modal --}}
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
