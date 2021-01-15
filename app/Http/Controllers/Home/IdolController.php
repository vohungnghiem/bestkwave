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
        $label = array();
        $vote = array();
        $like = array();
        for ($i=0; $i >= -5 ; $i--) { 
            $today_vote = DB::table('votes')
                ->whereDate('date_id',date('Y-m-d',strtotime($i. " days")))
                ->where('vote',1)
                ->select( DB::raw(' (CASE WHEN DATE_FORMAT(created_at,"%p") = "AM" THEN 1 END) AS dayam'), DB::raw(' (CASE WHEN DATE_FORMAT(created_at,"%p") = "PM" THEN 1 END) AS daypm') )
                ->get()->toArray();
                array_push($vote,array_sum(array_column($today_vote,'daypm')));
                array_push($vote,array_sum(array_column($today_vote,'dayam')));
            $today_like = DB::table('votes')
                ->whereDate('date_id',date('Y-m-d',strtotime($i." days")))
                ->where('like',1)
                ->select( DB::raw(' (CASE WHEN DATE_FORMAT(created_at,"%p") = "AM" THEN 1 END) AS dayam'), DB::raw(' (CASE WHEN DATE_FORMAT(created_at,"%p") = "PM" THEN 1 END) AS daypm') )
                ->get()->toArray();
                array_push($like,array_sum(array_column($today_like,'daypm')));
                array_push($like,array_sum(array_column($today_like,'dayam')));
            if ($i == 0) {
                array_push($label,'hôm nay : pm','hôm nay : am');
            }elseif ($i == -1) {
                array_push($label,'hôm qua : pm', 'hôm qua : am');
            }else {
                $date = date('d-m-Y',strtotime($i. " days"));
                array_push($label,$date.': pm', $date.': am');
            }
        }
        
        if (date('A') == "AM") {
            array_shift($label);
            array_shift($vote);
            array_shift($like);
        }
        $lists = DB::table('idols')
            ->leftJoin('votes','votes.idol_id','=','idols.id')
            ->where('status',1)
            ->select('idols.*',DB::raw('sum(votes.like) as sumlike'),DB::raw('sum(votes.vote) as sumvote'))
            ->orderBy('sumvote','desc')->limit(50)
            ->groupBy('votes.idol_id')
            ->get();
        return view('home.idol.statistic',['lists'=>$lists,'label'=>$label,'vote'=>$vote,'like'=>$like]);
    }

    public function ranking() 
    {
        $gender = isset($_GET['gender']) ? $_GET['gender'] : 1;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $perpage = 3;
        $curenrankpage = $page * $perpage - $page - 1 ;
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
