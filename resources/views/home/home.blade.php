@extends('home.layout.master')
@section('title', 'bestkwave')
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

@isset($adfirst)
<section class="qc-1">
    <a href="{{$adfirst->link}}" target="_blank"><img src="{{$adfirst->image}}" alt="advertisement"></a>
</section>
@endisset
<section class="video mt-5" width="100%">
    <iframe width="560" height="315" style="width:100%; min-height: 300px" src="https://www.youtube.com/embed/3PtJQhseIuE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</section>
<section class="home-lasted">
    @isset($adsecond)
    <aside class="qc-2 qc-2-left">
        <a href="{{$adsecond->link}}" target="_blank"><img src="{{$adsecond->image}}" alt="advertisement"></a>
    </aside>
    @endisset
    @isset($adthird)
    <aside class="qc-2 qc-2-right">
        <a href="{{$adthird->link}}" target="_blank"><img src="{{$adthird->image}}" alt="advertisement"></a>
    </aside>
    @endisset
    <div class="row" id="loadmore">
        @foreach ($latest as $item)
        <article class="col-md-4 col-12">
            <div class="home-item-article">
                <div class="item-image">
                    <a href="{{$item->slug}}">
                        <img src="public/uploads/thumb/{{$item->year}}/{{month($item->created_at)}}/{{$item->image}}?v={{time()}}"
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
        @isset($adseventh)
        <section class="qc-1 col-md-12">
            <a href="{{$adseventh->link}}" target="_blank"><img src="{{$adseventh->image}}" alt="advertisement"></a>
        </section>
        @endisset
        @foreach ($latestadd as $item)
        <article class="col-md-4 col-12">
            <div class="home-item-article">
                <div class="item-image">
                    <a href="{{$item->slug}}">
                        <img src="public/uploads/thumb/{{$item->year}}/{{month($item->created_at)}}/{{$item->image}}?v={{time()}}"
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
        <p><a class="nextpage" href="1">More Stories</a></p>
        <span></span>
    </div>
</section>
@isset($adfourth)
<section class="qc-1">
    <a href="{{$adfourth->link}}" target="_blank"><img src="{{$adfourth->image}}" alt="advertisement"></a>
</section>
@endisset
<section class="home-most">
    @isset($adeighth)
    <aside class="qc-3-left">
        <a href="{{$adeighth->link}}" target="_blank"><img src="{{$adeighth->image}}" alt="advertisement"></a>
    </aside>
    @endisset
    @isset($adfifth)
    <aside class="qc-3-right">
        <a href="{{$adfifth->link}}" target="_blank"><img src="{{$adfifth->image}}" alt="advertisement"></a>
    </aside>
    @endisset
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
@isset($adsixth)
<section class="qc-1">
    <a href="{{$adsixth->link}}" target="_blank"><img src="{{$adsixth->image}}" alt="advertisement"></a>
</section>
@endisset

@endsection
@push('javascript')
    <script type="text/javascript" src="public/home/script/moreajax.js?v={{time()}}"></script>
@endpush