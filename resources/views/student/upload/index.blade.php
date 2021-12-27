@extends('student.layouts.master')
@section('pagetitle')
    مشاهده فایل ها
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فایل های کلاس </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="text-center">
                                <th>شماره</th>
                                <th>نام کلاس</th>
                                <th>نام فایل</th>
                                <th>تاریخ انتشار</th>
                                <th>تنظیمات </th>
                            </tr>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($Uploadedfiles as $file)
                                <tr class="text-center">
                                    <td>{{ $number }}</td>
                                    <td>{{ $file->course->name }}</td>
                                    <td>{{ $file->file_name }}</td>
                                    <td>@php
                                        $starttime = $file->created_at;
                                        $startyear = intval(substr($starttime, 0, 4));
                                        $startmonth = intval(substr($starttime, 5, 7));
                                        $startday = intval(substr($starttime, 8, 11));
                                        $starttimearray = Verta::getJalali($startyear, $startmonth, $startday);
                                        $finalstartdate = $starttimearray[0] . '-' . $starttimearray[1] . '-' . $starttimearray[2];
                                        echo $finalstartdate;
                                    @endphp</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('student.file.download', $file->id) }}"
                                            class="btn btn-primary">دانلود فایل</a>
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
