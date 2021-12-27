@extends('ostad.layouts.master')
@section('pagetitle')
    پروفایل شما
@endsection
@section('content')
    <div class="card card-primary card-outline shadow">
        <div class="card-body box-profile">
            <div class="text-center">
                @php
                    $image = 'storage/' . auth()->user()->profile_photo_path;
                @endphp
                @if (auth()->user()->profile_photo_path !== null)
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset($image) }}"
                        alt="User profile picture">
                @endif
            </div>

            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

            <strong><i class="fa fa-book mr-1"></i> تحصیلات</strong>
            @if ($degree == null)
                <div>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#tahsilat">
                        پر کردن این بخش
                    </button>
                </div>
                <div class="modal fade mt-5" id="tahsilat" tabindex="-1" role="dialog" aria-labelledby="tahsilatlabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tahsilatlabel">بخش تحصیلات</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('profile.master.me.store.degree') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="degree" placeholder="دکترای ریاضی"
                                        id="tahil">
                                    <button type="button" class="btn btn-secondary mt-2 ml-2" data-dismiss="modal">منصرف
                                        شدم</button>
                                    <button type="submit" class="btn btn-primary mt-2">ذخیره</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted ">
                    {{ $degree }}
                </p>
            @endif
            <hr>

            <strong><i class="fa fa-map-marker mr-1"></i> موقعیت</strong>

            @if ($address == null)
                <div>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#address">
                        پر کردن این بخش
                    </button>
                </div>
                <div class="modal fade mt-5" id="address" tabindex="-1" role="dialog" aria-labelledby="addresstable"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addresstable">بخش آدرس</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('profile.master.me.store.address') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="degree" placeholder="ایران,تهران"
                                        id="tahil">
                                    <button type="button" class="btn btn-secondary mt-2 ml-2" data-dismiss="modal">منصرف
                                        شدم</button>
                                    <button type="submit" class="btn btn-primary mt-2">ذخیره</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted ">
                    {{ $address }}
                </p>
            @endif
            <hr>

            <strong><i class="fa fa-pencil mr-1"></i> مهارت‌ها</strong>
            @if ($talents[0] == null)
                <div>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#talents">
                        پر کردن این بخش
                    </button>
                </div>
                <div class="modal fade mt-5" id="talents" tabindex="-1" role="dialog" aria-labelledby="talentstable"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="talentstable">بخش استعداد ها</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('profile.master.me.store.talent') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="degree"
                                        placeholder="بعد از نوشتن هر مهارت یک فاصله بدهید مثال:ریاضی زبان" id="tahil">
                                    <button type="button" class="btn btn-secondary mt-2 ml-2" data-dismiss="modal">منصرف
                                        شدم</button>
                                    <button type="submit" class="btn btn-primary mt-2">ذخیره</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
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
                <div>
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#description">
                        پر کردن این بخش
                    </button>
                </div>
                <div class="modal fade mt-5" id="description" tabindex="-1" role="dialog" aria-labelledby="descriptiontable"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="descriptiontable">بخش یادداشت</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('profile.master.me.store.description') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" name="degree" placeholder="متنی درباره خودتان"
                                        id="tahil">
                                    <button type="button" class="btn btn-secondary mt-2 ml-2" data-dismiss="modal">منصرف
                                        شدم</button>
                                    <button type="submit" class="btn btn-primary mt-2">ذخیره</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted ">
                    {{ $description }}
                </p>
            @endif

            {{-- <a href="#" class="btn btn-primary btn-block"><b>متن تستی</b></a> --}}
        </div>
        <!-- /.card-body -->
    </div>

@endsection
