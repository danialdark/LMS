@extends('ostad.layouts.master')
@section('pagetitle')
    مشاهده دانشجو های شما
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr class="text-center">
                                <th>شماره</th>
                                <th>نام دانشجو</th>
                                <th>نام کلاس</th>
                                <th>تنظیمات </th>
                            </tr>
                            @php
                                $number = 1;
                            @endphp
                            @foreach ($users as $user)
                                <div class="card-header">
                                    <h3 class="card-title"> دانشجو های مسدود شده شما</h3>
                                </div>
                                <tr class="text-center">
                                    <td>{{ $number }}</td>
                                    <td><a href="{{ route('prof.show', $user->user->id) }}">{{ $user->user->name }}</a>
                                    </td>
                                    <td>{{ $user->course->name }}
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('master.class.index') }}" class="btn ml-2 btn-info">رفتن به
                                            لیست کلاس ها</a>
                                        <form action="{{ route('master.show.block.students.destroy', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">خارج کردن از لیست مسدود شده
                                                ها</button>
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
            <!-- /.card -->
        </div>
    </div>
@endsection
