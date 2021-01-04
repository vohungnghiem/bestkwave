@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="ranking">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#men">Idol Nam</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#woman">Idol Nữ</a>
		</li>
	</ul>
	<div class="tab-content">
		<div id="men" class="container tab-pane active"><br>
			<div id="no-more-tables">
				<table class="col-md-12 table-striped ">
					<h1 class="text-center">IDOL NAM</h1>
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
						<tr>
							<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/gold-medal.png" alt="gold medal"></td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-men.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm .</td>
							<td data-title="Nhóm">Nhóm </td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>
						<tr>
							<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/silver-medal.png" alt="silver medal"></td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-men.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm .</td>
							<td data-title="Nhóm">Nhóm </td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>	
						<tr>
							<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/bronze-medal.png" alt="bronze medal"></td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-men.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm .</td>
							<td data-title="Nhóm">Nhóm </td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>
						@for ($i = 4; $i < 21; $i++)
						<tr>
							<td data-title="Xếp hạng" class="num-rank">{{$i}}</td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-men.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm {{$i}}.</td>
							<td data-title="Nhóm">Nhóm {{$i}}</td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>	
						@endfor
						
					</tbody>
				</table>
			</div>
			
			<ul class="pagination pagination-md float-right">
				<li class="page-item"><a class="page-link" href="#">Previous</a></li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">Next</a></li>
			</ul>
			
		</div>
		<div id="woman" class="container tab-pane fade"><br>
			<div id="no-more-tables">
				<table class="col-md-12 table-striped ">
					<h1 class="text-center">IDOL NỮ</h1>
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
						<tr>
							<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/gold-medal.png" alt="gold medal"></td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-woman.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm .</td>
							<td data-title="Nhóm">Nhóm </td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>
						<tr>
							<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/silver-medal.png" alt="silver medal"></td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-woman.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm .</td>
							<td data-title="Nhóm">Nhóm </td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>	
						<tr>
							<td data-title="Xếp hạng" class="num-rank"><img src="public/home/image/bronze-medal.png" alt="bronze medal"></td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-woman.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm .</td>
							<td data-title="Nhóm">Nhóm </td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>
						@for ($i = 4; $i < 21; $i++)
						<tr>
							<td data-title="Xếp hạng" class="num-rank">{{$i}}</td>
							<td data-title="Hình" class="img-rank"><img src="public/home/image/idol-woman.jpg" alt=""></td>
							<td data-title="Tên"> Võ Hùng Nghiêm {{$i}}.</td>
							<td data-title="Nhóm">Nhóm {{$i}}</td>
							<td data-title="Số phiếu bầu">400.000</td>
							<td data-title="Bỏ phiếu" class="text-right"><a href="" class="btn btn-sm btn-bp">bỏ phiếu bầu</a></td>
						</tr>	
						@endfor
						
					</tbody>
				</table>
			</div>
			
			<ul class="pagination pagination-md float-right">
				<li class="page-item"><a class="page-link" href="#">Previous</a></li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">Next</a></li>
			</ul>
		</div>
	</div>

</section>
@endsection

@push('script')

@endpush