<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\SubReceive;
use App\Models\SubSend;
use App\Models\SubJob;
use App\Models\View;
use Carbon\Carbon;
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
   
}
