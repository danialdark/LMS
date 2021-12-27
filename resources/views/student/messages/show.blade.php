@extends('student.layouts.master')
@section('pagetitle')
    پیام های ارسال شده
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">پوشه‌ها</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="{{ route('student.message.index') }}" class="nav-link">
                                <i class="fa fa-inbox"></i> تمامی پیام ها
                                @if ($unseen > 0)
                                    <span class="badge bg-primary float-left">{{ $unseen }}</span>
                                @endif

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.message.sent') }}" class="nav-link">

                                <i class="fa fa-envelope-o"></i> ارسال شده
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.message.received') }}" class="nav-link">
                                <i class="fa fa-trash-o"></i> دریافت شده
                                @if ($unseen > 0)
                                    <span class="badge bg-primary float-left">{{ $unseen }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /. box -->
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">خواندن پیام</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h5>{{ $notif->subject }}</h5>
                        @if (auth()->user()->id === $notif->sender_id)
                            <a href="{{ route('profs.show', $notif->receiver->id) }}">به : {{ $notif->receiver->name }}
                                <span class="mailbox-read-time float-left">{{ $notif->created_at }}</span>
                            </a>
                        @else
                            <a href="{{ route('profs.show', $notif->sender->id) }}">از : {{ $notif->sender->name }}
                                <span class="mailbox-read-time float-left">{{ $notif->created_at }}</span>
                            </a>
                        @endif

                    </div>
                    <div class="mailbox-read-message">
                        <p>{{ $notif->text }}</p>


                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-footer -->
                <div class="card-footer">
                    <div class="float-left">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-reply"></i> پاسخ
                        </button>

                    </div>
                    <div class="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <input type="hidden" class="form-control" value="{{ auth()->user()->id }}"
                                            name="sender_id">
                                        <input type="hidden" class="form-control" value="{{ $notif->sender->id }}"
                                            name="receiver_id">
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
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /. box -->
        </div>
    @endsection
    @section('script')
        <!-- iCheck -->
        <script src="{{ asset('panel/plugins/iCheck/icheck.min.js') }}"></script>
        <script src="{{ asset('panel/plugins/fastclick/fastclick.js') }}"></script>
        <!-- Page Script -->
        <script>
            $(function() {
                //Enable iCheck plugin for checkboxes
                //iCheck for checkbox and radio inputs
                $('.mailbox-messages input[type="checkbox"]').iCheck({
                    checkboxClass: 'icheckbox_flat-blue',
                    radioClass: 'iradio_flat-blue'
                })

                //Enable check and uncheck all functionality
                $('.checkbox-toggle').click(function() {
                    var clicks = $(this).data('clicks')
                    if (clicks) {
                        //Uncheck all checkboxes
                        $('.mailbox-messages input[type=\'checkbox\']').iCheck('uncheck')
                        $('.fa', this).removeClass('fa-check-square-o').addClass('fa-square-o')
                    } else {
                        //Check all checkboxes
                        $('.mailbox-messages input[type=\'checkbox\']').iCheck('check')
                        $('.fa', this).removeClass('fa-square-o').addClass('fa-check-square-o')
                    }
                    $(this).data('clicks', !clicks)
                })

                //Handle starring for glyphicon and font awesome
                $('.mailbox-star').click(function(e) {
                    e.preventDefault()
                    //detect type
                    var $this = $(this).find('a > i')
                    var glyph = $this.hasClass('glyphicon')
                    var fa = $this.hasClass('fa')

                    //Switch states
                    if (glyph) {
                        $this.toggleClass('glyphicon-star')
                        $this.toggleClass('glyphicon-star-empty')
                    }

                    if (fa) {
                        $this.toggleClass('fa-star')
                        $this.toggleClass('fa-star-o')
                    }
                })
            })
        </script>
    @endsection
    @section('headadd')
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('panel/plugins/iCheck/flat/blue.css') }}">
    @endsection
