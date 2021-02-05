@extends('home.layout.master')
@section('title', $post->title.' | (Best K wave)')
@section('description', $post->description)
@section('header')
    @include('home.layout.header-two')
@endsection
@section('content')

<div class="post" page="{{ $more->currentPage() }}" slug="{{$post->slug}}">
    <div class="post-wrapper">
        <div class="post-header">
            <div class="post-cat-title" @if($parentcat) urlpage="category/{{$parentcat->slug}}" @else urlpage="category/{{$post->slugcat}}" @endif> {{$post->titlecat}} | {{$post->date}} </div>
            <h1 class="post-title">{{$post->title}}</h1>
            <div class="fb-like" data-href="https://bestkwave.com/{{$post->slug}}" data-width="" data-layout="button" data-action="like" data-size="large" data-share="true"></div>
            <div class="post-caption">{{$post->caption}}</div>
            <div class="hr-left"></div>
        </div>
        <div class="post-content">
            {!!$post->content!!}
        </div>
        <div class="hr-left"></div>
        <div class="post-social">
            @if ($post->linksocial)
                {{explodesnot($post->linksocial)}}
            @else
                <a href="http://facebook.com" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
                <a href="http://twitter.com" target="_blank"><i class="fab fa-twitter-square fa-2x"></i></a>
                <a href="http://youtube.com" target="_blank"><i class="fab fa-youtube-square fa-2x"></i></a>
            @endif            
        </div>
    </div>
    @foreach ($more as $item)    
    <div class="post-list" >
        <article class="row">
            <div class="col-md-4">
                <a href="{{$item->slug}}">
                    <img src="public/uploads/thumb/{{$item->year}}/{{month($item->created_at)}}/{{$item->image}}" onerror="this.onerror=null; this.src='public/home/image/non_image.png'" alt="{{$item->title}}" />
                </a>
            </div>
            <div class="col-md-8">
                <h2><a href="{{$item->slug}}">{{$item->title}}</a> </h2>
                <div class="date">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </div>
                
                <div class="caption">{!!  substr(strip_tags($item->caption), 0,130) !!}</div>
                <a href="{{$item->slug}}" class="btn-detail">detail +</a>
            </div>
        </article>
    </div>
    @endforeach 
</div>
@endsection 
@push('javascript')
    <script type="text/javascript" src="public/home/script/feedajax.js?v={{time()}}"></script>
@endpush
@push('facescript')
<img style="display: none" src="public/uploads/thumb/{{year($post->created_at)}}/{{month($post->created_at)}}/{{$post->image}}" />
@endpush