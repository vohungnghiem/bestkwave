@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="listidol">
    <div class="row listidol-search ">
        <div class="col-md-8 col-12">
            <form action="/" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm Tên Idol">
                    <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-12 text-left">
            <div class="btn-group ">
                <button type="button" class="btn btn-bright dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    Giới tính (tất cả)
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" type="button">Tất cả</a>
                    <a class="dropdown-item" type="button">Nam Idol</a>
                    <a class="dropdown-item" type="button">Nữ Idol</a>
                </div>
              </div>
        </div>
    </div>

    <div class="row listidol-idol">
        @for ($i = 1; $i < 13; $i++)
        <div class="col-md-2 col-6 item-idol-hover">
            <div class="item-idol">
                <a href="">
                    <img src="public/home/image/idol-men.jpg" alt="">
                </a>
                <div class="box-idol">
                    <div class="name-idol">Võ Hùng Nghiêm</div>
                    <div class="group-idol">Không có group</div>
                    <div class="like-idol"><i class="fas fa-heart"></i> 300.000</div>
                </div>
            </div>
        </div>    
        @endfor
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
</section>
@endsection

@push('script')

@endpush