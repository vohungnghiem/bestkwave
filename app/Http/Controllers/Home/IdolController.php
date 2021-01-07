<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
class IdolController extends Controller
{
    public function index() 
    {
    // view
        return view('home.idol.statistic',[]);
    }

    public function ranking() 
    {
    // view
        return view('home.idol.ranking',[]);
    }

    public function list() 
    {
    // view
        return view('home.idol.list',[]);
    }
    public function detail() 
    {
    // view
        return view('home.idol.detail',[]);
    }
}
