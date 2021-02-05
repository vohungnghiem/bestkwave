@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="listidol">
    {{-- <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-arrow-alt-circle-left"></i> BEST IDOL</a></li>
		  <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
		</ol>
	</nav> --}}
    <nav id="breadcrumb" >
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-arrow-alt-circle-left"></i> BEST IDOL</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
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
    <div class="row listidol-search ">
        <div class="col-md-8 col-12">
            <form action="idol/list" method="GET">
                <div class="input-group">
                    <input type="text" name="key" class="form-control" placeholder="Tìm Tên Idol" value="{{$key}}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-12 text-left">
            <div class="btn-group ">
                <button type="button" class="btn btn-bright dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    @if ($gender == 0)
                        Giới tính (tất cả)
                    @endif
                    @foreach ($genders as $item)
                        @if ($item->id == $gender)
                            {{$item->title}}
                        @endif
                    @endforeach
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a  href="idol/list?gender=0" class="dropdown-item" type="button">Giới tính (tất cả)</a>
                    @foreach ($genders as $item)
                        <a  href="idol/list?gender={{$item->id}}" class="dropdown-item" type="button">{{$item->title}}</a>
                    @endforeach
                </div>
              </div>
        </div>
    </div>

    <div class="row listidol-idol">
        @foreach ($lists as $item)
        <div class="col-md-2 col-6 item-idol-hover">
            <div class="item-idol">
                <a href="idol/detail/{{$item->id}}">
                    <img src="public/uploads/idol/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->avatar}}" alt="">
                </a>
                <div class="box-idol">
                    <div class="name-idol">{{$item->nickname}}</div>
                    <div class="group-idol">{{$item->group_name}}</div>
                    <div class="like-idol"><i class="fas fa-heart"></i> {{$item->sumvote}}</div>
                </div>
            </div>
        </div>    
        @endforeach
    </div>
    <nav aria-label="Page navigation example" >
        <div class="pagination justify-content-center">
          {{ $lists->onEachSide(2)->links() }}
        </div>
      </nav>
</section>
@include('home.idol.modal')
@endsection

@push('script')

@endpush