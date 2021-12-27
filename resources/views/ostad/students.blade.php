@extends('ostad.layouts.master')
@section('pagetitle')
    مشاهده دانشجو های شما
@endsection
@section('content')
    <div class="row">
        @foreach ($courses as $course)
            @php
                $number = 1;
            @endphp
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title"> دانشجو های کلاس {{ $course->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr class="text-center">
                                    <th>شماره</th>
                                    <th>نام دانشجو</th>
                                    <th>تنظیمات کلاس</th>
                                </tr>

                                @foreach ($course->users as $user)

                                    <tr class="text-center">
                                        <td>{{ $number }}</td>
                                        <td><a href="{{ route('prof.show', $user->id) }}">{{ $user->name }}</a></td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('master.class.index') }}" class="btn ml-2 btn-info">رفتن به
                                                کلاس {{ $course->name }}</a>
                                            <form action="{{ route('master.block.students') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="master_id" value="{{ auth()->user()->id }}">
                                                <button type="submit" class="btn btn-danger">حذف
                                                    دانشجو
                                                    از کلاس</button>
                                            </form>
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
        @endforeach
        <!-- /.card -->
    </div>
    </div>
@endsection
