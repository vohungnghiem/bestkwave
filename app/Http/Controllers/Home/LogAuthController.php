<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
class LogAuthController extends Controller
{
    public function signup( Request $request) 
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
        ],[
            'name.required' => 'Tên không để trống',
            'email.required' => 'Email không để trống'
        ]);
        echo $request->name;
        echo $request->email;
        echo $request->password;
        echo $request->passwordVerify;
        // exit();
        return redirect()->back();
    }
}
