@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="ranking">
    {{-- <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Idol Nam</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Idol Nữ</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Xếp hạng</th>
                        <th>Tên</th>
                        <th>Nhóm</th>
                        <th>Số phiếu bầu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="public/home/image/idol-men.jpg" alt="" style="width: 40px"> Võ Hùng Nghiêm</td>
                        <td>Nhóm nhạc a</td>
                        <td>400.000 </td>
                        <td class="text-right"><span class="btn btn-sm btn-secondary">bỏ phiếu bầu</span></td>
                    </tr>
                  
                </tbody>
            </table>
        </div>
        <div id="menu1" class="container tab-pane fade"><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Xếp hạng</th>
                        <th>Tên</th>
                        <th>Nhóm</th>
                        <th>Số phiếu bầu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><img src="public/home/image/idol-men.jpg" alt="" style="width: 40px"> Võ Hùng Nghiêm</td>
                        <td>Nhóm nhạc</td>
                        <td>400.000 </td>
                        <td class="text-right"><span class="btn btn-sm btn-secondary">bỏ phiếu bầu</span></td>
                    </tr>
                  
                </tbody>
            </table>

        </div>
    </div> --}}
    <div class="container mt-3">
        <h2>Toggleable Tabs</h2>
        <br>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
          </li>
        </ul>
      
        <!-- Tab panes -->
        <div class="tab-content">
          <div id="home" class="container tab-pane active"><br>
            <h3>HOME</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
          <div id="menu1" class="container tab-pane fade"><br>
            <h3>Menu 1</h3>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
          <div id="menu2" class="container tab-pane fade"><br>
            <h3>Menu 2</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
          </div>
        </div>
      </div>
</section>
@endsection

@push('script')

@endpush