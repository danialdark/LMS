@extends('student.layouts.master')
@section('pagetitle')
    مشاهده کلاس ها
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">لیست جلسات کلاس</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="text-center">
                                <th>شماره</th>
                                <th>نام جلسه</th>
                                <th>تاریخ کلاس</th>
                                <th>تنظیمات </th>
                            </tr>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($videos as $video)
                                <tr class="text-center">
                                    <td>{{ $number }}</td>
                                    <td>{{ $video->video_name }}</td>
                                    <td>@php
                                        $starttime = $video->created_at;
                                        $startyear = intval(substr($starttime, 0, 4));
                                        $startmonth = intval(substr($starttime, 5, 7));
                                        $startday = intval(substr($starttime, 8, 11));
                                        $starttimearray = Verta::getJalali($startyear, $startmonth, $startday);
                                        $finalstartdate = $starttimearray[0] . '-' . $starttimearray[1] . '-' . $starttimearray[2];
                                        echo $finalstartdate;
                                    @endphp</td>
                                    <td class="d-flex justify-content-center">
                                        <a class=" btn btn-primary ml-2" href="{{ $video->video_path }}">مشاهده</a>
                                    </td>
                                </tr>
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
