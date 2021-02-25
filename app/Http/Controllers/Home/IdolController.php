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
    public function index(Request $request) 
    {
        $request->session()->put('backurlsocial', $request->path());

        $label = array();
        $mainvote = array();
        $nickname = array();
        $idol_ids = array();
        // label 5 name
        $arridol = DB::table('idols')
            ->leftJoin('votes','votes.idol_id','=','idols.id')
            ->select('idols.*',DB::raw('sum(votes.vote) as sumvote'))
            ->orderBy('sumvote','desc')->limit(5)
            ->groupBy('votes.idol_id')
            ->get()->toArray();   
        foreach ($arridol as $key => $value) {
            array_push($nickname,$value->nickname);
            array_push($idol_ids,$value->id);
        }
        // label ngày
        for ($i=-7; $i <= 0 ; $i++) {
            $date = date('d-m-Y',strtotime($i. " days"));
            if ($i == -7) {
                $date = "";
            }
            array_push($label,$date);
        }
        // line
        foreach ($idol_ids as $key => $idol_id) {  
            $vote = array();
            for ($i=-7; $i <= 0 ; $i++) { 
                $today_vote_am = DB::table('votes')
                    ->where([['vote',1],['idol_id', $idol_id]])
                    ->where('votes.created_at','<=',date('Y-m-d H:i:s', strtotime($i. " days") ))
                    ->count();
                if ($i == -7) {
                    $today_vote_am = "0";
                }
                array_push($vote,$today_vote_am);  
                
            }
            array_push($mainvote,$vote);
        }
        // list right
        $lists = DB::table('idols')
            ->leftJoin('votes','votes.idol_id','=','idols.id')
            ->where('status',1)
            ->select('idols.*',DB::raw('sum(votes.vote) as sumvote'))
            ->orderBy('sumvote','desc')->limit(50)
            ->groupBy('votes.idol_id')
            ->get();
        return view('home.idol.statistic',['lists'=>$lists,'label'=>$label,'mainvote'=>$mainvote,'nickname'=>$nickname ]);
    }
    /*
    public function index() 
    {
        $label = array();
        
        $mainvote = array();
        $nickname = array();
        $idol_ids = array();
        // label name
        $arridol = DB::table('idols')
            ->leftJoin('votes','votes.idol_id','=','idols.id')
            ->select('idols.*',DB::raw('sum(votes.vote) as sumvote'))
            ->orderBy('sumvote','desc')->limit(5)
            ->groupBy('votes.idol_id')
            ->get()->toArray();   
        foreach ($arridol as $key => $value) {
            array_push($nickname,$value->nickname);
            array_push($idol_ids,$value->id);
        }
        // label ngày
        for ($i=0; $i >= -5 ; $i--) {
            $date = date('d-m-Y',strtotime($i. " days"));
            array_push($label,$date, $date);
        }
        if (date('A') == "AM") {
            array_shift($label);
        }
        // line
        foreach ($idol_ids as $key => $idol_id) {  
            $vote = array();
            for ($i=0; $i >= -5 ; $i--) { 
                $date_am = date('Y-m-d', strtotime($i. " days")). " 12:00:00";
                $date_pm = date('Y-m-d', strtotime($i. " days")). " 23:59:59";
                $today_vote_am = DB::table('votes')
                    ->where([['vote',1],['idol_id', $idol_id]])
                    ->where('votes.created_at','<=',date('Y-m-d H:i:s', strtotime($date_am) ))
                    ->count();
                $today_vote_pm = DB::table('votes')
                    ->where([['vote',1],['idol_id', $idol_id]])
                    ->where('votes.created_at','<=',date('Y-m-d H:i:s', strtotime($date_pm) ))
                    ->count();

                array_push($vote,$today_vote_pm);
                array_push($vote,$today_vote_am);  
            }
            if (date('A') == 'AM') {
               array_shift($vote);
            }
            array_push($mainvote,$vote);
        }
        
        $lists = DB::table('idols')
            ->leftJoin('votes','votes.idol_id','=','idols.id')
            ->where('status',1)
            ->select('idols.*',DB::raw('sum(votes.vote) as sumvote'))
            ->orderBy('sumvote','desc')->limit(50)
            ->groupBy('votes.idol_id')
            ->get();
        return view('home.idol.statistic',['lists'=>$lists,'label'=>$label,'mainvote'=>$mainvote,'nickname'=>$nickname ]);
    }
<<<<<<< HEAD
    */

    public function ranking(Request $request) 
    {
        $request->session()->put('backurlsocial', $request->path());

        $gender = isset($_GET['gender']) ? $_GET['gender'] : 1;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 20;
        $curenrankpage = $page * $perpage - $perpage ;
        $lists = DB::table('idols')
        ->leftJoin('votes','votes.idol_id','=','idols.id')
        ->where('status',1)
        ->when($gender, function ($query, $gender) {
            if (($gender != 1)) { return $query->where('idols.gender_id', $gender); }
        })
        ->select('idols.*',DB::raw('sum(votes.like) as sumlike'),DB::raw('sum(votes.vote) as sumvote'))
        ->orderBy('sumvote','desc')
        ->groupBy('id')
        ->paginate($perpage)
        ->withPath('idol/ranking?perpage='.$perpage.'&gender='.$gender);
        $genders = DB::table('genders')->orderBy('sort','desc')->get();
        $gender = DB::table('genders')->where('id',$gender)->first();
        return view('home.idol.ranking',['lists'=>$lists,'genders'=>$genders,'gender'=>$gender,'curenrankpage'=>$curenrankpage]);
    }

    public function list(Request $request ) 
    {
        $request->session()->put('backurlsocial', $request->path());
        try {
            $key = isset($_GET['key']) ? $_GET['key'] : null;
            $gender = isset($_GET['gender']) ? $_GET['gender'] : null;
            $perpage = 12;
            $lists = DB::table('idols')
                ->leftJoin('votes','votes.idol_id','=','idols.id')
                ->where('status',1)
                ->when($key, function ($query, $key) {
                    if ($key != '') { return $query->where('idols.nickname', 'like', '%' . $key . '%'); }
                })
                ->when($gender, function ($query, $gender) {
                    if ($gender != '') { return $query->where('idols.gender_id', $gender); }
                })
                ->select('idols.*',DB::raw('sum(votes.like) as sumlike'),DB::raw('sum(votes.vote) as sumvote'))
                ->groupBy('id')->paginate($perpage)
                ->withPath('idol/list?perpage='.$perpage.'&key='.$key.'&gender='.$gender);
            $genders = DB::table('genders')->orderBy('sort','desc')->get();
            return view('home.idol.list',['lists'=>$lists,'genders'=>$genders,'key'=>$key,'gender'=>$gender]);

        } catch (\Throwable $th) {
            return redirect('page/error');
        }
    }
    public function detail(Request $request ,$id) 
    {
        $request->session()->put('backurlsocial', $request->path());
        try {
            $idol = DB::table('idols')
                ->leftJoin('professions','professions.id','=','idols.profession_id')
                ->leftJoin('genders','genders.id','=','idols.gender_id')
                ->where([['idols.id',$id],['idols.status',1]])
                ->select('idols.*','professions.title as profession','genders.title as gender')
                ->first();
            if ($idol == null) {
                return redirect('page/error');
            }
            $gallery = Gallery::where('idol_id',$id)->get();
            $idollike = null;
            $idolvote = null;
            if ( Auth::user() && Auth::user() != null) {
                $idolvote = DB::table('votes')
                    ->where([['idol_id',$id],['user_id',Auth::user()->id],['vote',1]])
                    ->whereDate('date_id', date('Y-m-d'))
                    ->exists();
                $idollike = DB::table('votes')
                    ->where([['idol_id',$id],['user_id',Auth::user()->id],['like',1]])
                    ->whereDate('date_id', date('Y-m-d'))
                    ->exists();
            }
            $sumlike = DB::table('votes')->where('idol_id',$id)->sum('like');
            $sumvote = DB::table('votes')->where('idol_id',$id)->sum('vote');
            return view('home.idol.detail',['idol'=>$idol,'gallery'=>$gallery,'idolvote'=>$idolvote,'idollike'=>$idollike,'sumlike'=>$sumlike,'sumvote'=>$sumvote]);
        } catch (\Throwable $th) {
            return redirect('page/error');
        }
    }
    public function vote($id) 
    {
        $count = DB::table('votes')->where([['user_id',Auth::user()->id]])->whereDate('date_id', date('Y-m-d'))->count();
        if ($count > 5) {
            return redirect()->back()->with('error','Bạn đã hết lượt vote trong ngày hôm nay. Mời bạn quay lại vào ngày hôm sau nhé !');
        }
        $d = DB::table('votes')->where([['idol_id',$id],['user_id',Auth::user()->id]])->whereDate('date_id', date('Y-m-d'))->exists();
        if ($d) {
            DB::table('votes')
                ->where([['idol_id',$id],['user_id',Auth::user()->id]])->whereDate('date_id', date('Y-m-d'))
                ->update([
                    'vote' => 1,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        } else {
            DB::table('votes')->insert([
                'idol_id' => $id,
                'user_id' => Auth::user()->id,
                'date_id'  => date("Y-m-d"),
                'vote' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);    
        }        
        return redirect()->back()->with('success','Bạn đã vote idol này vào hôm nay !');
    }
    public function like($id) 
    {
        $count = DB::table('votes')->where([['user_id',Auth::user()->id]])->whereDate('date_id', date('Y-m-d'))->count();
        if ($count > 5) {
            return redirect()->back()->with('error','Bạn đã hết lượt vote trong ngày hôm nay. Mời bạn quay lại vào ngày hôm sau nhé !');
        }
        $d = DB::table('votes')->where([['idol_id',$id],['user_id',Auth::user()->id]])->whereDate('date_id', date('Y-m-d'))->exists();
        if ($d) {
            DB::table('votes')
                ->where([['idol_id',$id],['user_id',Auth::user()->id]])->whereDate('date_id', date('Y-m-d'))
                ->update([
                    'like' => 1,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        } else {
            DB::table('votes')->insert([
                'idol_id' => $id,
                'user_id' => Auth::user()->id,
                'date_id'  => date("Y-m-d"),
                'like' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        return redirect()->back()->with('success','Bạn đã thích idol này vào hôm nay !');
    }
}
