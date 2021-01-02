@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="detailidol">
    <div class="row idol-detail ">
        <div class="col-md-5 col-12">
            <div class="idol-profile">
                <div class="pro-header">
                    <h3>Hồ sơ</h3>
                    <div class="pro-question" title="Hồ sơ" data-toggle="popover" data-placement="left"
                        data-content="
                        <div class='popover-tt'>Thông tin thần tượng</div>
                        <div class='popover-tt'>Thông tin này cập nhật 10 phút 1 lần</div>
                        <div class='popover-cn'>cập nhật lần cuối: 2020-01-01 00:00:00</div>">
                        <i class="far fa-question-circle fa-2x"></i>
                    </div>
                </div>
                <div class="pro-box">
                    <div class="pro-list">
                        <div class="pro-key">Tên thần tượng</div>
                        <div class="pro-value">Jimin</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Tên thậ</div>
                        <div class="pro-value"> Công viên Jimin</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Tên Nhóm</div>
                        <div class="pro-value">Hướng đạo sinh chống đạn</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Đại lý</div>
                        <div class="pro-value"> Big Hit Entertainment</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Sinh</div>
                        <div class="pro-value"> 1995-10-13</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">thông tin thần tượng</div>
                        <div class="pro-value"> Ca sĩ</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Giới tính</div>
                        <div class="pro-value"> Đàn ông</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Tự nhiên</div>
                        <div class="pro-value"> Busan</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Chìa khóa</div>
                        <div class="pro-value"> 175cm</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Cân nặng</div>
                        <div class="pro-value"> 100kg</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-12">
            <div class="detail-top">
                <div class="detail-background">
                    <img src="public/home/image/idol-men.jpg" alt="">
                    <div class="mo"></div>
                </div>
                <div class="detail-img">
                    <img src="public/home/image/idol-men.jpg" alt="">
                    <div class="name">Jimin</div>
                    <div class="agency">Hướng đạo sinh chống đạn</div>
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
                @for ($i = 1; $i < 10; $i++) <div class="col-md-4 col-6 detail-item">
                    <a href="public/home/image/idol-men.jpg" data-lightbox="photos">
                        <img class="img-fluid" src="public/home/image/idol-men.jpg">
                    </a>
            </div>
            @endfor
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
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email1" placeholder="Your email address...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password1" placeholder="Your password...">
                        </div>
                        <button type="button" class="btn btn-info btn-block btn-round">Login</button>
                    </form>

                    <div class="text-center text-muted delimiter">or use a social network</div>
                    <div class="d-flex justify-content-center social-buttons">
                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip"
                            data-placement="top" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip"
                            data-placement="top" title="Facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip"
                            data-placement="top" title="Linkedin">
                            <i class="fab fa-linkedin"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Not a member yet? <a href="#a" class="text-info"> Sign Up</a>.</div>
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
@endpush