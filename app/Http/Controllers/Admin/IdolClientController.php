<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Idol;
use App\Models\Profession;
use App\Models\Gender;
use App\Models\Gallery;
use Illuminate\Support\Str;

class IdolClientController extends Controller
{
    public function client()
    {
        $month = isset($_GET['month']) ? $_GET['month'] : 0;
        $year = isset($_GET['year']) ? $_GET['year'] : 0;
        $clients = DB::table('votes')
        ->join('users','votes.user_id','=','users.id')
        ->when($month, function ($query, $month) {
            if (($month != 0)) { return $query->whereMonth('votes.created_at', $month); }
        })
        ->when($year, function ($query, $year) {
            if (($year != 0)) { return $query->whereYear('votes.created_at', $year); }
        })
        ->select('users.*',DB::raw('sum(votes.like) as sumlike'),DB::raw('sum(votes.vote) as sumvote'))
        ->orderBy('sumvote','desc')
        ->groupBy('users.id')->get();
        // dd($lists);
        return view('admin.idolclient.client',['clients'=>$clients,'month'=>$month,'year'=>$year]);
    }
    
    public function idol()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $month = isset($_GET['month']) ? $_GET['month'] : 0;
        $year = isset($_GET['year']) ? $_GET['year'] : 0;
        $idols = DB::table('votes')
        ->join('idols','votes.idol_id','=','idols.id')
        ->when($id, function ($query, $id) {
            if (($id != 0)) { return $query->where('votes.user_id', $id); }
        })
        ->when($month, function ($query, $month) {
            if (($month != 0)) { return $query->whereMonth('votes.created_at', $month); }
        })
        ->when($year, function ($query, $year) {
            if (($year != 0)) { return $query->whereYear('votes.created_at', $year); }
        })
        ->select('idols.*',DB::raw('sum(votes.like) as sumlike'),DB::raw('sum(votes.vote) as sumvote'))
        ->orderBy('sumvote','desc')
        ->groupBy('idols.id')->get();
        // dd($idols);
        return view('admin.idolclient.idol',
            ['idols'=>$idols,'month'=>$month,'year'=>$year,'id'=>$id]
        );
    }
    
}
