@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="ranking">
	{{-- <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-arrow-alt-circle-left"></i> BEST IDOL</a></li>
		  <li class="breadcrumb-item active" aria-current="page">Xếp hạng</li>
		</ol>
	</nav> --}}
	<nav id="breadcrumb" >
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-arrow-alt-circle-left"></i> BEST IDOL</a></li>
            <li class="breadcrumb-item active" aria-current="page">Xếp hạng</li>
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
	<ul class="nav nav-tabs">
		@foreach ($genders as $item)
		<li class="nav-item">
			<a class="nav-link @if($item->id == $gender->id) active @endif" href="idol/ranking?gender={{$item->id}}">Idol {{$item->title}}</a>
		</li>	
		@endforeach
		
	</ul>
	<div class="tab-content">
		<div id="men" class="container tab-pane active"><br>
			<div id="no-more-tables">
				<table class="col-md-12 table-striped ">
					<h2 class="text-center">IDOL {{$gender->title}}</h2>
					<thead >
						<tr>
							<th width="8%">Xếp hạng</th>
							<th width="10%"></th>
							<th width="32%">Tên</th>
							<th width="20%">Nhóm</th>
							<th width="15%">Số phiếu bầu</th>
							<th width="15%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($lists as $key => $item)
							@php
								$i = ++$curenrankpage;
							@endphp
						<tr>
							@if ($i == 1)
								<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/gold-medal.png" alt="gold medal"></td>
							@elseif($i == 2)
								<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/silver-medal.png" alt="silver medal"></td>
							@elseif($i == 3)
								<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/bronze-medal.png" alt="bronze medal"></td>
							@else
								<td data-title="Xếp hạng" class="num-rank">{{$i}}</td>
							@endif
							<td data-title="Hình" class="img-rank"><img src="public/uploads/idol/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->avatar}}" alt=""></td>
							<td data-title="Tên"> {{$item->nickname}}</td>
							<td data-title="Nhóm">{{$item->group_name}}</td>
							<td data-title="Số phiếu bầu">{{$item->sumvote}}</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="idol/detail/{{$item->id}}" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>	
						@endforeach
						
					</tbody>
				</table>
			</div>

			<nav aria-label="Page navigation example " >
				<div class="pagination justify-content-center mt-3">
				  {{ $lists->onEachSide(2)->links() }}
				</div>
			  </nav>
		</div>
		
	</div>

</section>
@include('home.idol.modal')
@endsection

@push('script')

@endpush