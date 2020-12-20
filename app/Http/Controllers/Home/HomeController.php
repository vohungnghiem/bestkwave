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
use Carbon\Carbon;
use Session;
class HomeController extends Controller
{
    public function index() 
    {
    // view
        $sessionIP = \Request::ip();  
        //Session::forget($sessionIP);

        $sessionView = Session::get($sessionIP);
        // Session::put($sessionIP, $sessionView);
        // dd($sessionIP);
        // $view = Post::findOrFail($post->id);
        if (!isset($sessionView)) { 
            Session::put($sessionIP, 1); 
            // $view->increment('view');
        }else {
            Session::put($sessionIP, null); 
            
        }
        dd(Session::get($sessionIP));
    // index
        $banners = DB::table('posts')->where([['type_post',2],['status',1]])->orderByDesc('id')->limit(4)->get();
        $latest = DB::table('posts')
            ->join('categories','categories.id','=','posts.category')
            ->where([['posts.status',1],['categories.status',1]])
            ->whereNotIn('posts.type_post',[2])
            ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date'))
            ->orderBy('id','desc')->paginate(9);
        $most = DB::table('posts')->where('status',1)->whereNotIn('type_post',[2])->orderBy('view','desc')->limit(5)->get();
        return view('home.home',['banners'=>$banners,'latest'=>$latest,'most'=>$most]);
    }
    public function getLoadmore() 
    {
    // more
        $latest = DB::table('posts')
            ->join('categories','categories.id','=','posts.category')
            ->where([['posts.status',1],['categories.status',1]])
            ->whereNotIn('posts.type_post',[2])
            ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date')
            )
            ->orderBy('id','desc')->paginate(9);
        return json_encode($latest);
    }
    public function category($slug) 
    {
    // category pagination
        try {
            $catparent  = DB::table('categories')->where([['slug',$slug],['status',1]])->first();
            $catchild   = DB::table('categories')->where([['parent',$catparent->id],['status',1]])->orderBy('sort','asc')->get(); 
            $catfirst   = DB::table('categories')->where([['parent',$catparent->id],['status',1]])->orderBy('sort','asc')->first();

            $arrall = $catchild->pluck('slug')->toArray();
            $posts = DB::table('posts')
                ->join('categories','categories.id','=','posts.category')
                ->where([['categories.status',1],['posts.status',1]])
                ->whereIn('categories.slug', $arrall)
                ->whereNotIn('posts.type_post',[2])
                ->select('posts.*','categories.slug AS slugcat','categories.title AS titlecat',
                    DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                    DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date'))
                ->orderBy('id','desc')->paginate(9);
            return view('home.category',['catparent'=>$catparent,'catchild'=>$catchild,'posts'=>$posts]);
        } catch (\Throwable $th) {
            return redirect('page/error');
        }
       
    }
    public function categoryChild($cat,$slug) 
    {
    // category pagination
        $catparent  = DB::table('categories')->where('slug',$cat)->first();
        $catchild   = DB::table('categories')->where('parent',$catparent->id)->orderBy('sort','asc')->get(); 
        $posts = DB::table('posts')
            ->join('categories','categories.id','=','posts.category')
            ->where([['categories.slug',$slug],['categories.status',1],['posts.status',1]])
            ->whereNotIn('posts.type_post',[2])
            ->select('posts.*','categories.slug AS slugcat','categories.title AS titlecat',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date'))
            ->orderBy('id','desc')->paginate(9);
        return view('home.category',['catparent'=>$catparent,'catchild'=>$catchild,'posts'=>$posts]);
    }
    public function post($slug) 
    {
    // post
        try {    
            $post = DB::table('posts')
                ->join('categories','categories.id','=','posts.category')
                ->leftJoin('social_posts','social_posts.id_post','=','posts.id')
                ->leftJoin('socials','socials.id','=','social_posts.id_social')
                ->where([['posts.slug',$slug],['posts.status',1]])
                ->select('posts.*','categories.slug AS slugcat','categories.title AS titlecat',
                    DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                    DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date'),
                    DB::raw('GROUP_CONCAT(DISTINCT socials.slug,"|",social_posts.link) as linksocial')
                )
                ->groupBy('social_posts.id_post')
                ->first();
            // view
            $sessionKey = 'post_' . $post->id; // Session::forget($sessionKey);
            $sessionView = Session::get($sessionKey);
            $view = Post::findOrFail($post->id);
            if (!$sessionView) { 
                Session::put($sessionKey, 1); 
                $view->increment('view');
            }

            $checkcat = DB::table('categories')->where('id',$post->category)->first();
            if ($checkcat) {
                $parentcat = DB::table('categories')->where('id',$checkcat->parent)->first();
            }
            $posts = DB::table('posts')->get();
            $more = DB::table('posts')
                ->join('categories','categories.id','=','posts.category')
                ->where([['posts.status',1],['categories.status',1],['categories.slug',$checkcat->slug]])
                ->whereNotIn('posts.type_post',[2])
                ->whereNotIn('posts.id',[$post->id])
                ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                    DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"))
                ->orderBy('id','desc')
                ->paginate(3);
            return view('home.post',['post'=>$post,'parentcat'=>$parentcat,'posts'=>$posts,'more'=>$more]);
        } catch (\Throwable $th) {
            return redirect('page/error');
        }
    }
    public function feed($slug) 
    {
    // loadmore in post
        $post = DB::table('posts')
            ->where([['posts.slug',$slug],['posts.status',1]])
            ->select('posts.*')->first();
        $checkcat = DB::table('categories')->where('id',$post->category)->first();
        if ($checkcat) {
            $parentcat = DB::table('categories')->where('id',$checkcat->parent)->first();
        }
        $more = DB::table('posts')
            ->join('categories','categories.id','=','posts.category')
            ->where([['posts.status',1],['categories.status',1],['categories.slug',$checkcat->slug]])
            ->whereNotIn('posts.type_post',[2])
            ->whereNotIn('posts.id',[$post->id])
            ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date') )
            ->orderByDesc('id')
            ->paginate(3);
        return json_encode($more);
    }
    public function getSubscribe() 
    {
    // subscribe
        $subsends = SubSend::where('status',1)->get();
        $subreceives = SubReceive::where('status',1)->get();
        $subjobs = SubJob::where('status',1)->get();
        return view('home.subscribe',['subsends'=>$subsends,'subreceives'=>$subreceives,'subjobs'=>$subjobs]);
    }
    public function postSubscribe(Request $request) 
    {
    // subscribe
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|unique:subscribes'
        ],[
            'name.required' => 'Tên không để trống',
            'name.min' => 'Tên dưới dưới 3 ký tự',
            'email.unique' => 'Bạn đã đăng ký rồi!'
        ]);

        $subscribe = new Subscribe;
        $subscribe->name = $request->name;
        $subscribe->birthday = $request->birthday;
        $subscribe->email = $request->email;
        $subscribe->receive = $request->receive;
        $subscribe->address = $request->address;
        $subscribe->message = $request->message;
        $subscribe->job = $request->job;
        $subscribe->send = $request->send;
        $subscribe->status = 0;

        $subscribe->created_at = date("Y-m-d H:i:s");
        $subscribe->updated_at = date("Y-m-d H:i:s");
        $subscribe->save();
        return redirect()->back()->with('success','Đăng ký nhận tin thành công!');
    }
    public function getAbout() 
    {
    // about
        return view('home.about');
    }
    public function getAdvertisement() 
    {
    // about
        return view('home.advertisement');
    }
    public function postSearch(Request $request)
    {
    // search
        $search = $request->search;
        $posts = DB::table('posts')
            ->join('categories','categories.id','=','posts.category')
            ->where([['categories.status',1],['posts.status',1]])
            ->whereNotIn('posts.type_post',[2])
            ->where('posts.title','LIKE','%'.$search.'%')
            ->select('posts.*','categories.slug AS slugcat','categories.title AS titlecat',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"),
                DB::raw('DATE_FORMAT(posts.created_at, "%Y.%m.%d") date'))
            ->orderBy('id','desc')->paginate(9);
        return view('home.search',['search'=>$search,'posts'=>$posts]);
    }
    public function getError() {
        return view('home.error');
    }
}
