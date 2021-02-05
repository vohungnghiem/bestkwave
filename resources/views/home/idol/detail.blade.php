@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="detailidol">
    <nav id="breadcrumb" >
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-arrow-alt-circle-left"></i> BEST IDOL</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
		</ol>
        @if(Auth::user())
        <div class="dropdown">
            <div class="bread-right " id="dropdownMenuButton" data-toggle="dropdown"> 
                <span>{{Auth::user()->name}}</span> 
                @if (Auth::user()->avatar != '')
                    <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}"  onerror="this.onerror=null; this.src='public/home/image/non_avatar.png'">
                @else
                    <i class="far fa-user"></i>
                @endif
            </div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="logauth/info/{{Auth::user()->id}}"><i class="far fa-user"></i> Tên: {{Auth::user()->name}}</a>
                <a class="dropdown-item" href="logauth/info/{{Auth::user()->id}}"><i class="fas fa-people-arrows"></i> Tài khoản: {{Auth::user()->provider}}</a>
                <a class="dropdown-item" href="logauth/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>
        @else
        <div class="dropdown" data-toggle="modal" data-target="#loginModal">
            <div  class="bread-right "> 
                <span>Đăng nhập</span> <i class="far fa-user"></i>
            </div>
        </div>
        @endif
	</nav>
    <div class="row idol-detail ">
        <div class="col-12">
            @if(Auth::user())
            <div class="float-left">
                <h6>Tài khoản: {{Auth::user()->provider}}</h6>
                <h5>Tên: {{Auth::user()->name}}</h5>
            </div>
                <a href="logauth/logout" class="btn btn-secondary btn-sm m-1 float-right">Đăng xuất</a>
            @endif
        </div>
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
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
                        <div class="pro-key">Công ty quản lý</div>
                        <div class="pro-value"> {{$idol->agency_name}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Sinh</div>
                        <div class="pro-value"> {{date("d/m/Y", strtotime($idol->birthday))}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Thông tin thần tượng</div>
                        <div class="pro-value"> {{$idol->profession}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Giới tính</div>
                        <div class="pro-value"> {{$idol->gender}}</div>
                    </div>
                    <div class="pro-list">
                        <div class="pro-key">Quê quán</div>
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
                    @if (Auth::user())
                        @if ($idollike)
                            <a class="btn-voted-i" data-toggle="popover" data-placement="left" title="Thông báo" data-content="<div class='popover-tt'>Hôm nay bạn đã thích idol này rồi <br> Quay lại hôm sau bạn nhé !</div>">
                                <i class="fas fa-heart"></i></a>
                        @else
                            <a href="idol/like/{{$idol->id}}"><i class="far fa-heart"></i></a>
                        @endif
                        @if ($idolvote)
                            <a data-toggle="popover" data-placement="left" title="Thông báo" data-content="<div class='popover-tt'>Hôm nay bạn đã vote cho idol này rồi <br> Quay lại hôm sau bạn nhé !</div>" class="btn-vote btn-voted">vote</a>
                        @else
                            <a href="idol/vote/{{$idol->id}}" class="btn-vote">vote</a>
                        @endif
                    @else
                        <a href="" data-toggle="modal" data-target="#loginModal"><i class="far fa-heart"></i></a>
                        <a href="" class="btn-vote" data-toggle="modal" data-target="#loginModal">vote</a>
                    @endif
                    
                </div>
                <div class="detail-tab">
                    <div class="tab-bot vote">
                        <div>{{$sumvote}} </div>
                        <div>vote</div>
                    </div>
                    <div class="tab-bot like">
                        <div>{{$sumlike}} </div>
                        <div>like</div>
                    </div>
                </div>
            </div>
            <div class="row detail-bottom">
                @foreach ($gallery as $item)
                <div class="col-md-4 col-6 detail-item d-flex align-items-center">
                    <a href="{{$item->image}}" data-lightbox="photos">
                        <img class="img-fluid" src="{{$item->image}}">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@include('home.idol.modal')

@endsection

@push('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
@endpush