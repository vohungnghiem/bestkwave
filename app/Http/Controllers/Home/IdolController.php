<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use App\Models\Idol;
use App\Models\Gallery;
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

    public function list(Request $request ) 
    {
        $request->session()->put('backurlsocial', $request->path());
    // view
        return view('home.idol.list',[]);
    }
    public function detail(Request $request ,$id) 
    {
        $request->session()->put('backurlsocial', $request->path());
        try {
            $idol = DB::table('idols')
            ->leftJoin('professions','professions.id','=','idols.profession_id')
            ->leftJoin('genders','genders.id','=','idols.gender_id')
            ->where([['idols.id',$id],['idols.status',1]])
            ->select('idols.*','professions.title as profession','genders.title as gender')->first();
            $gallery = Gallery::where('idol_id',$id)->get();
            if ($idol == null) {
                return redirect('page/error');
            }
            return view('home.idol.detail',['idol'=>$idol,'gallery'=>$gallery]);
        } catch (\Throwable $th) {
            return redirect('page/error');
        }
    }
}
