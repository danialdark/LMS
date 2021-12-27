@extends('student.layouts.master')
@section('pagetitle')
    پروفایل {{ $name }}
@endsection
@section('content')
    <div class="card card-primary card-outline shadow">
        <div class="card-body box-profile">
            <div class="text-center">
                @php
                    $image = 'storage/' . $photo;
                @endphp
                @if ($photo !== null)
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset($image) }}"
                        alt="User profile picture">
                @endif
            </div>

            <h3 class="profile-username text-center">{{ $name }}</h3>

            <strong><i class="fa fa-book mr-1"></i> تحصیلات</strong>
            @if ($degree == null)
                {{ 'ندارد' }}
            @else
                <p class="text-muted ">
                    {{ $degree }}
                </p>
            @endif
            <hr>

            <strong><i class="fa fa-map-marker mr-1"></i> موقعیت</strong>

            @if ($address == null)
                {{ 'ندارد' }}
            @else
                <p class="text-muted ">
                    {{ $address }}
                </p>
            @endif
            <hr>

            <strong><i class="fa fa-pencil mr-1"></i> مهارت‌ها</strong>

            @if ($talents[0] == null)
                {{ 'ندارد' }}
            @else
                <p class="text-muted">
                    @foreach ($talents as $talent)


                        <span class="badge badge-success">{{ $talent }}</span>
                    @endforeach
                </p>
            @endif


            <hr>

            <strong><i class="fa fa-file-text-o mr-1"></i> یادداشت</strong>

            @if ($description == null)
                {{ 'ندارد' }}
            @else
                <p class="text-muted ">
                    {{ $description }}
                </p>
            @endif

            {{-- <a href="#" class="btn btn-primary btn-block"><b>متن تستی</b></a> --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-reply"></i> ارسال پیام
    </button>
    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">متن پیام</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('student.message.store') }}" method="POST">
                        @csrf
                        <label for="subject">موضوع</label>
                        <input type="text" id="subject" class="form-control" name="subject">
                        <label for="text">متن</label>
                        <input type="text" id="text" class="form-control" name="text">
                        <input type="hidden" class="form-control" value="{{ auth()->user()->id }}" name="sender_id">
                        <input type="hidden" class="form-control" value="{{ $id }}" name="receiver_id">
                        <button type="button" class="btn btn-secondary mt-5" data-dismiss="modal">منصرف
                            شدم</button>
                        <button type="submit" class="btn btn-primary mt-5 mr-2">ارسال</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

@endsection
