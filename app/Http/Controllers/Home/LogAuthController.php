<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Auth;
class LogAuthController extends Controller
{
    public function info($id)
    {
        if ( (!Auth::user()) || (Auth::user()->id != $id ) ) {
            return redirect('idol/statistic');
        } else {
            $user = User::find($id);
            $list = DB::table('votes')->paginate(9);
            return view('home.idol.info',['user'=>$user]);
        }   
    }
    public function changePassWord( Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            'passwordVerify' => 'same:password'
        ],[
            'password.required'  => 'Nhập mật khẩu mới để đăng nhập',
            'passwordVerify.same' => 'Mật khẩu không trùng khớp'
        ]);
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('success','Đăng ký thành công !');
    }
    public function getSignup()
    {
        return view('home.idol.signup');
    }
    public function postSignup( Request $request) 
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'passwordVerify' => 'same:password'
        ],[
            'name.required' => 'Tên không để trống',
            'name.max'  => 'Tên gì dài thế',
            'email.required' => 'Email không để trống',
            'email.email'   => 'Có phải email đâu',
            'password.required'  => 'Không có mật khẩu làm sao đăng nhập',
            'passwordVerify.same' => 'Mật khẩu không đúng kìa'
        ]);
        $findemail = DB::table('users')->where([['email',$request->email],['provider','system']])->first();
        if ($findemail) {
            return redirect()->back()->with('error','Tài khoản đã tồn tại !');
        }
        $logauth = new User;
        $logauth->name = $request->name;
        $logauth->email = $request->email;
        $logauth->password = bcrypt($request->password);
        $logauth->provider = 'system';
        $logauth->level = 0;
        $logauth->save();
        return redirect()->back()->with('success','Đăng ký thành công !');
    }
    public function postLogin ( Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }

    }
    public function logout ()
    {
        Auth::logout();
        return redirect()->back();
    }
}
