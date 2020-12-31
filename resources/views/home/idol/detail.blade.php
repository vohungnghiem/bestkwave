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
                    <div class="pro-question" title="Header" data-toggle="popover" data-placement="left" data-content="Content"><i class="far fa-question-circle fa-2x"></i></div>
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
                    <a href=""><i class="fas fa-heart"></i></a>
                    <a href="" class="btn-vote">vote</a>
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
        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });
    </script>
@endpush