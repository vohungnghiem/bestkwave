@extends('admin.layout.master')
@section('title', 'Admincp | Edit Subscribe')
@section('content')

<div class="content-wrapper">
    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Subscribe</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/subscribe">Subscribe</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="subscribe">
                    <form method="POST" action="{{url('admincp/subscribe/'.$subscribe->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="hr-left"></div>
                        <h2>Necessary information</h2>
                        <table>
                            <tr>
                                <td>Name (*)</td>
                                <td>
                                    <input name="name" type="text" value="{{$subscribe->name}}" required placeholder="Nhập tên" >
                                    <span class="error">{{$errors->first('name')}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Email (*)</td>
                                <td>
                                    <input name="email" type="email" value="{{$subscribe->email}}" required placeholder="Nhập email" >
                                    <select name="receive">
                                        @foreach ($subreceives as $item)
                                            <option value="{{$item->id}}" @if($item->id == $subscribe->receive) selected @endif >{{$item->title}}</option>                                        
                                        @endforeach
                                    </select>
                                    <span class="error">{{$errors->first('email')}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Birthday</td>
                                <td>
                                    <input name="birthday" type="number" value="{{$subscribe->birthday}}" placeholder="Nhập năm sinh"> 
                                    <span class="span">fill the year of birth (ex: 1988)</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input name="address" class="form-control" value="{{$subscribe->address}}" type="text" placeholder="Nhập địa chỉ">
                                </td>
                            </tr>
                            <tr>
                                <td>Thông điệp</td>
                                <td>
                                    <textarea name="message" class="form-control" rows="2" placeholder="Nhập Thông điệp">{{$subscribe->message}}</textarea>
                                </td>
                            </tr>
                        </table>
                
                        <div class="hr-left"></div>
                        <h2>Optional information</h2>
                        <table>
                            <tr>
                                <td>Job</td>
                                <td>
                                    <select name="job">
                                        @foreach ($subjobs as $item)
                                            <option value="{{$item->id}}" @if($item->id == $subscribe->job) selected @endif >{{$item->title}}</option>                                        
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Type of Send Subscribe</td>
                                <td>
                                    <select name="send">
                                        @foreach ($subsends as $item)
                                            <option value="{{$item->id}}" @if($item->id == $subscribe->send) selected @endif >{{$item->title}}</option>                                        
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="noti">
                            <p>* Sau khi xác nhận thông tin bạn nhập là chính xác, nhấn xác nhận để hoàn tất.</p>
                            <div class="submit">
                                <input type="submit" class="btn-noti btn btn-dark" value="xác nhận">
                                <input type="reset" class="btn-noti btn btn-dark" value="Hủy bỏ">
                                <a class="btn btn-dark" href="admincp/subscribe"> Back list </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </section>
</div>

@endsection
@section('javascript')
<style>
    
    h2 {
        font-size: 18px;
        font-weight: bold;
    }

    table,
    th,td{
        border: 1px solid gray;
        border-collapse: collapse;
       
    }
    table {
        border-top: 3px solid lightslategrey;
        width: 100%;
        margin: 20px 0px;
    }
    td {
        font-size: 15px;
        padding: 5px 10px;
    }
    tr {
        min-height: 100px;
    }
    tr>td:first-child {
        background: lightslategrey;
        width: 30%;
        font-weight: bold;
        color: white;
    }
    select {
        margin: 4px;
        padding: 7px;
        color: gray;
    }
    input {
        margin: 4px;
        padding: 4px;
    }
    .span {
        font-size: 13px;
        color: gray;
    }
    .noti {
        text-align: center;
        p {
            font-size: 14px;
            color: gray;
        }
        .btn-noti {
            width: 80px;
            background: white;
            border: 1px solid black;
        }
    }
    .error {
        color: red;
        margin: 3px;
    }

</style>
@endsection