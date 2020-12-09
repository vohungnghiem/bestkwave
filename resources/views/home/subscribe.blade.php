@extends('home.layout.master')
@section('title', 'Subscribe | (Best K wave)')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
    @include('home.layout.header-two')
@endsection
@section('content')
<div class="subscribe">
    <form action="subscribe/send" method="POST">
        @csrf
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Thành công!</strong> Bạn đã đăng ký nhận tin thành công.
            </div>
        @endif
        <div class="hr-left"></div>
        <h2>Thông tin cần thiết</h2>
        <table>
            <tr>
                <td>Tên (*)</td>
                <td>
                    <input name="name" type="text" value="{{old('name')}}" required placeholder="Nhập tên">
                    <span class="error">{{$errors->first('name')}}</span>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ email (*)</td>
                <td>
                    <input name="email" type="email" value="{{old('email')}}" required placeholder="Nhập email" >
                    <select name="receive">
                        @foreach ($subreceives as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                    <span class="error">{{$errors->first('email')}}</span>
                </td>
            </tr>
            <tr>
                <td>Năm sinh</td>
                <td>
                    <input name="birthday" type="number" value="{{old('birthday')}}" placeholder="Nhập năm sinh"> 
                    <span class="span">Nhập năm (ví dụ: 1988)</span>
                </td>
            </tr>
            
            <tr>
                <td>Địa chỉ</td>
                <td>
                    <input name="address" class="form-control" value="{{old('address')}}" type="text" placeholder="Nhập địa chỉ">
                </td>
            </tr>
            <tr>
                <td>Thông điệp</td>
                <td>
                    <textarea name="message" class="form-control" rows="2" placeholder="Nhập Thông điệp">{{old('message')}}</textarea>
                </td>
            </tr>
        </table>

        <div class="hr-left"></div>
        <h2>Thông tin tùy chọn</h2>
        <table>
            <tr>
                <td>Việc làm</td>
                <td>
                    <select name="job">
                        @foreach ($subjobs as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Phân loại được gửi</td>
                <td>
                    <select name="send">
                        @foreach ($subsends as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <div class="noti">
            <p>* Sau khi xác nhận thông tin bạn nhập là chính xác, nhấn xác nhận để hoàn tất.</p>
            <div class="submit">
                <input type="submit" class="btn-noti" value="xác nhận">
                <input type="reset" class="btn-noti" value="Hủy bỏ">
            </div>
        </div>
    </form>
</div>
@endsection 