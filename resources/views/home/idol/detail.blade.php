@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="detailidol">
    <div class="row idol-detail ">
        <div class="col-12">
            @if(Auth::user())
                <h6>đăng nhập: {{Auth::user()->provider}}</h6>
                <h4>{{Auth::user()->name}}</h4>
            @endif
        </div>
        <div class="col-md-6 col-12">
            <div class="idol-profile">
                <div class="pro-header">
                    <h3>Hồ sơ</h3>
                    <div class="pro-question" title="Hồ sơ" data-toggle="popover" data-placement="left"
                        data-content="
                        <div class='popover-tt'>Thông tin thần tượng</div>
                        <div class='popover-tt'>Thông tin này cập nhật 10 phút 1 lần</div>
                        <div class='popover-cn'>cập nhật lần cuối: {{$idol->updated_at}}</div>">
                        <i class="far fa-question-circle fa-2x"></i>
                    </div>
                </div>
                <div class="pro-box">
                    <div class="pro-list">
                        <div class="pro-key">Tên thần tượng</div>
                        <div class="pro-value">{{$idol->nickname}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Tên thật</div>
                        <div class="pro-value"> {{$idol->name}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Tên Nhóm</div>
                        <div class="pro-value">{{$idol->group_name}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Đại lý</div>
                        <div class="pro-value"> {{$idol->agency_name}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Sinh</div>
                        <div class="pro-value"> {{$idol->birthday}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">thông tin thần tượng</div>
                        <div class="pro-value"> {{$idol->profession}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Giới tính</div>
                        <div class="pro-value"> {{$idol->gender}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Tự nhiên</div>
                        <div class="pro-value"> {{$idol->nature}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Chiều cao</div>
                        <div class="pro-value"> {{$idol->height}} cm</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Cân nặng</div>
                        <div class="pro-value"> {{$idol->weight}} kg</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="detail-top">
                <div class="detail-background">
                    <img src="public/uploads/idol/{{year($idol->created_at)}}/{{month($idol->created_at)}}/{{$idol->avatar}}?v={{time()}}" alt="">
                    <div class="mo"></div>
                </div>
                <div class="detail-img">
                    <img src="public/uploads/idol/{{year($idol->created_at)}}/{{month($idol->created_at)}}/{{$idol->avatar}}?v={{time()}}" alt="">
                    <div class="name">{{$idol->nickname}}</div>
                    <div class="agency">{{$idol->agency_name}}</div>
                </div>
                <div class="detail-vote">
                    <a href="" data-toggle="modal" data-target="#loginModal"><i class="fas fa-heart"></i></a>
                    <a href="" class="btn-vote" data-toggle="modal" data-target="#loginModal">vote</a>
                </div>
                <div class="detail-tab">
                    <div class="tab-bot vote">
                        <div>23.000 </div>
                        <div>vote</div>
                    </div>
                    <div class="tab-bot like">
                        <div>23.000 </div>
                        <div>like</div>
                    </div>
                </div>
            </div>
            <div class="row detail-bottom">
                @foreach ($gallery as $item)
                <div class="col-md-4 col-6 detail-item">
                    <a href="{{$item->image}}" data-lightbox="photos">
                        <img class="img-fluid" src="{{$item->image}}">
                    </a>
                </div>
                @endforeach
        </div>
    </div>
    </div>
</section>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-title text-center">
                    <h4>Login</h4>
                </div>
                <div class="d-flex flex-column text-center">
                    <form action="logauth/login" method="post" id="loginLogAuth">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="emailLogAuth" placeholder="Your email address...">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="passwordLogAuth" placeholder="Your password...">
                        </div>
                        <div class="form-group text-left">
                            <div class="icheck-secondary">
                                <input type="checkbox" name="remember" id="rememberLogAuth" checked >
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-round">Login</button>
                    </form>

                    <div class="text-center text-muted delimiter">or use a social network</div>
                    <div class="d-flex justify-content-center social-buttons">
                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Google"><i class="fab fa-google"></i></a>
                        <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="{{ url('/auth/redirect/zalo') }}" class="btn btn-light btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="fab fa-zalo"></i>
                            <img src="public/home/image/zalo.svg" alt="" width="18px">
                        </a>
                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter"> <i class="fab fa-twitter"></i> </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Not a member yet? <a href="logauth/signup" class="text-info" > Sign Up</a>.</div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@push('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({html: true});
    });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    $(document).ready(function() {
        var remember = $.cookie('rememberLogAuth');
        if (remember == 'true') 
        {
            var email = $.cookie('emailLogAuth');
            var password = atob($.cookie('passwordLogAuth'));
            $('#emailLogAuth').val(email);
            $('#passwordLogAuth').val(password);
            $('#rememberLogAuth').prop('checked', true);
        }
        $("#loginLogAuth").submit(function() {
            if ($('#rememberLogAuth').is(':checked')) {
                var email = $('#emailLogAuth').val();
                var password = btoa($('#passwordLogAuth').val());
                $.cookie('emailLogAuth', email, { expires: 365 });
                $.cookie('passwordLogAuth', password, { expires: 365 });
                $.cookie('rememberLogAuth', true, { expires: 365 });
            }
          
        });

        $("#resetLogAuth").click(function() {
            $.cookie('emailLogAuth', null);
            $.cookie('passwordLogAuth', null);
            $.cookie('rememberLogAuth', null);
        });

    });
</script>
@endpush