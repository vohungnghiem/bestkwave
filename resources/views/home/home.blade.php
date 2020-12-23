@extends('home.layout.master')
@section('title', 'KWave kết nối đọc giả | (Best K wave)')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('banner')
<section id="banner" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        @foreach ($banners as $key => $item)
            <li data-target="#banner" data-slide-to="{{$key}}" @if ($key == 0) class="active" @endif ></li>
        @endforeach
    </ul>
    <div class="carousel-inner">
        @foreach ($banners as $key => $item)
            <div class="carousel-item @if ($key == 0) active @endif ">
                <a href="{{$item->link}}"><img src="public/uploads/thumb/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->image}}?v={{time()}}" 
                    onerror="this.onerror=null; this.src='public/uploads/logobg/logo.png'" alt="{{$item->title}}" /></a>
            </div>    
        @endforeach
        
    </div>
</section>
@endsection
@section('header')
    @include('home.layout.header')
@endsection
@section('content')
<section class="qc-1">
    <img src="public/uploads/advertisement/so1.jpg" alt="advertisement">
</section>
<section class="home-lasted">
    <aside class="qc-2 qc-2-left">
        <img src="public/uploads/advertisement/so2.jpg" alt="advertisement">
    </aside>
    <aside class="qc-2 qc-2-right">
        <img src="public/uploads/advertisement/so2.jpg" alt="advertisement">
    </aside>
    <div class="row" id="loadmore">
        @foreach ($latest as $item)
        <article class="col-md-4 col-12">
            <div class="home-item-article">
                <div class="item-image">
                    <a href="{{$item->slug}}">
                        <img src="public/uploads/thumb/{{$item->year}}/{{$item->month}}/{{$item->image}}?v={{time()}}"
                        onerror="this.onerror=null; this.src='public/home/image/non_image.png'" alt="{{$item->title}}" />
                    </a>
                </div>
                <div class="item-text">
                    <p class="item-cat">{{$item->title_cat}}</p>
                    <h2 class="item-title"><a href="{{$item->slug}}">{{$item->title}}</a></h2>
                    {{-- <p class="item-date">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </p> --}}
                    <p class="item-date">{{ $item->date}} </p>
                </div>
            </div>
        </article>
        @endforeach
       
    </div>
    <div class="btn-more">
        <p><a class="nextpage" href="{{ $latest->currentPage() }}">load more stories</a></p>
        <span></span>
    </div>
</section>
<section class="qc-1">
    <img src="public/uploads/advertisement/so1.jpg" alt="advertisement">
</section>
<section class="home-most">
    <aside class="qc-3-right">
        <img src="public/uploads/advertisement/so3.jpg" alt="advertisement">
    </aside>
    <h1 class="home-most-title">most popular</h1>
    <div class="hr"></div>
    <div class="home-most-list">
        @foreach ($most as $key => $item)
        <article class="home-most-article">
            <a href="{{$item->slug}}">
                <div class="home-most-num">0{{++$key}}</div>
                <div class="home-most-text">
                    <h2>{{$item->title}}</h2>
                </div>
                <div class="home-most-image">
                    <img src="public/uploads/thumb/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->image}}" 
                    onerror="this.onerror=null; this.src='public/home/image/non_image.png'" alt="{{$item->title}}" />
                </div>
            </a>
        </article>
        @endforeach
    </div>
</section>
<section class="qc-1">
    <img src="public/uploads/advertisement/so1.jpg" alt="advertisement">
</section>
@endsection
@push('javascript')
    <script type="text/javascript" src="public/home/script/moreajax.js?v={{time()}}"></script>
@endpush