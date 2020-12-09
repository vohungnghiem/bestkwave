@extends('home.layout.master')
@section('title', $catparent->title.' | (Best K wave)')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
    @include('home.layout.header-two')
@endsection
@section('content')
<div class="category">
    <h1 class="cat-head">{{$catparent->title}}</h1>
    <div class="hr"></div>
    <div class="sub-menu">
        <ul>
            <li ><a href="category/{{$catparent->slug}}" >ALL </a></li>
            @foreach ($catchild as $key => $item)
                <li ><a href="category/{{$catparent->slug}}/{{$item->slug}}" >{{$item->title}}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="cat-article-wrap">   
       @foreach ($posts as $item)
        <article class="row cat-article">
            <div class="col-12 col-md-4 cat-article-left">
                <a href="{{$item->slug}}" class="post-image">
                    <img src="public/uploads/thumb/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->image}}" onerror="this.onerror=null; this.src='public/home/image/non_image.png'" alt="{{$item->title}}" />
                </a>
            </div>
            <div class="col-12 col-md-8 cat-article-right">
                <div class="cat-article-top">
                    <a class="cat-title"> {{$catparent->title}}, {{$item->titlecat}} </a>
                    <h2 class="post-title"><a href="{{$item->slug}}" >{{$item->title}}</a></h2>
                    <div class="post-caption">  {!!  substr(strip_tags($item->caption), 0,130) !!}</div>
                </div>
                <div class="cat-article-bottom">
                    <span>{{$item->date}}</span>
                    <div class="hr-left"></div>
                </div>
            </div>
        </article>
        @endforeach
    </div>
    <div class="float-right">
    {{$posts}}
    </div>
</div>
@endsection