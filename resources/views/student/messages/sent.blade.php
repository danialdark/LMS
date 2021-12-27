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
                    <h3 class="card-title">اینباکس</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="جستجو پیام">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-controls">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <td class="text-center">موضوع</td>
                                    <td class="text-center">فرستنده و خصلاصه متن</td>
                                    <td class="text-center"></td>
                                    <td class="text-center">تاریخ</td>
                                    @if (count($notifications) !== 0)


                                        @foreach ($notifications as $notification)
                                            <tr>
                                                @if ($notification->status == 0)
                                                    <td class="mailbox-name text-center"><a
                                                            href="{{ route('student.message.show', $notification->id) }}">{{ $notification->subject }}</a>
                                                    </td>
                                                @else
                                                    <td class="mailbox-name text-center"><a class="text-dark"
                                                            href="{{ route('student.message.show', $notification->id) }}">{{ $notification->subject }}</a>
                                                    </td>
                                                @endif

                                                <td class="mailbox-subject text-center">
                                                    <b>{{ $notification->sender->name }}:</b>
                                                    {{ substr($notification->text, 0, 25) }}...

                                                </td>
                                                <td class="mailbox-attachment text-center">
                                                    {{-- <form
                                                        action="{{ route('master.message.destroy', $notification->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <div class="btn-group">
                                                            <button type="submit" class="btn btn-default btn-sm"><i
                                                                    class="fa fa-trash-o"></i></button>
                                                            <!-- /.btn-group -->
                                                        </div>
                                                    </form> --}}
                                                </td>
                                                <td class="mailbox-date text-center">{{ $notification->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            </td>
                                            <td class="mailbox-name"><a href="read-mail.html"></a></td>
                                            <td class="mailbox-subject">چیزی برای نمایش وجود ندارد
                                            </td>
                                            <td class="mailbox-attachment"></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer p-0">
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
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
