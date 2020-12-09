<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\TypePost;
use App\Models\Post;
use App\Models\Social;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::join('categories','categories.id','=','posts.category')
            ->whereNotIn('type_post', [2])
            ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"))
            ->orderByDesc('id')
            ->get();
        return view('admin.post.index',['posts'=>$posts,'type'=>1]);
    }
    
    public function create()
    {
        $categories = Category::where('status',1)->get();

        $type = isset($_GET['type']) ? $_GET['type'] : null;
        $typeposts = TypePost::whereNotIn('id', [2])->where('status',1)->get();
        if (isset($type) && ($type == 2)) {
            $typeposts = TypePost::where([['id',2],['status',1]])->get();
        }
        $socials = Social::where('status',1)->get();
        return view('admin.post.create',['categories'=>$categories,'typeposts'=>$typeposts,'type'=>$type,'socials'=>$socials]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
        ]);
        $id_latest = Post::latest()->first();
        $id_slug = $id_latest ? ($id_latest->id + 1) : 1;  
        $post = new Post;
        $post->category = $request->category;
        $post->type_post = $request->type_post;
        $post->image = $request->image;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-').'-'.$id_slug;
        $post->caption = $request->caption;
        $post->link = $request->link;
        $post->content = $request->content;
        $post->status = ($request->status == 'on' ? 1 : 0);
        $post->view = 0;
        $post->key = $request->key;
        $post->description = $request->description;
        $post->created_at = date("Y-m-d H:i:s");
        $post->updated_at = date("Y-m-d H:i:s");

        // image
        $image = $request->image;         
        $name_image = $post->slug;
        if (strlen($image) >= 200){
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $name_image . '.jpg';    
            Storage::disk('local')->put("/thumb"."/".year($post->created_at)."/".month($post->created_at)."/".$imageName, base64_decode($image));
            $post->image = $imageName;
        }
        if ($image == "default") {          
            Storage::delete('thumb/'.year($post->created_at).'/'.month($post->created_at).'/'.$post->image);
            $post->image = NULL;
        }
        $post->save();

        $data_social = array();
        foreach ($request->social as $key => $item) {
            if($item != null) {
                array_push($data_social,[
                    'id_post'=> $post->id,
                    'id_social'=>$key,
                    'link'=> $item,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]);
            }
        }
        DB::table('social_posts')->insert($data_social);
        if ($request->type_post == 2) {
            return redirect('admincp/banner/'.$post->id.'/edit')->with('success','Success !');
        }else{
            return redirect('admincp/post/'.$post->id.'/edit')->with('success','Success !');
        }
        
    }
    public function edit($id)
    {        
        $post = Post::find($id);  
        $categories = Category::where('status',1)->get();    

        $type = $post->type_post; 
        $typeposts = TypePost::whereNotIn('id', [2])->where('status',1)->get();

        $socials = Social::where('status',1)->get();
        $get_social = DB::table("socials")
            ->leftJoin('social_posts','social_posts.id_social','=','socials.id')
            ->where("id_post", $id)
            ->get() ;
        return view('admin.post.edit',[
            'post'=>$post,'typeposts'=>$typeposts,'categories'=>$categories,'type'=>$type,
            'socials'=>$socials,'get_social'=>$get_social
            ]);
    }
    public function banner() 
    {
        $posts = Post::join('categories','categories.id','=','posts.category')
            ->where('type_post',2)
            ->select('posts.*','categories.slug AS slug_cat','categories.title AS title_cat','categories.parent AS parent',
                DB::raw("MONTH(posts.created_at) month"),DB::raw("YEAR(posts.created_at) year"))
            ->orderBy('id','desc')
            ->get();
        return view('admin.post.banner',['posts'=>$posts,'type'=>2]);
    }
    public function createBanner() 
    {
        $categories = Category::where('status',1)->get();
        $typeposts = TypePost::where([['id',2],['status',1]])->get();
        $socials = Social::where('status',1)->get();
        return view('admin.post.create-banner',['categories'=>$categories,'typeposts'=>$typeposts,'socials'=>$socials]);
    }
    public function editBanner($id)
    {        
        $post = Post::find($id);  
        $categories = Category::where('status',1)->get();    

        $type = $post->type_post; 
        $typeposts = TypePost::where([['id',2],['status',1]])->get();
       
        $socials = Social::where('status',1)->get();
        $get_social = DB::table("socials")
            ->leftJoin('social_posts','social_posts.id_social','=','socials.id')
            ->where("id_post", $id)
            ->get() ;
        return view('admin.post.edit-banner',[
            'post'=>$post,'typeposts'=>$typeposts,'categories'=>$categories,'type'=>$type,
            'socials'=>$socials,'get_social'=>$get_social
            ]);
    }
    public function update(Request $request,$id)
    {       
        $request->validate([
            'title' => 'required|max:200',
        ]);
        $post = Post::find($id);   
        $id_slug = $post->id;  
        $post->type_post = $request->type_post;
        $post->category = $request->category;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-').'-'.$id_slug;
        $post->caption = $request->caption;
        $post->link = $request->link;
        $post->content = $request->content;
        $post->status = ($request->status == 'on' ? 1 : 0);
        $post->key = $request->key;
        $post->description = $request->description;
        $post->updated_at = date("Y-m-d H:i:s");

        $image = $request->image;         
        $name_image = $post->slug;
    
        if (strlen($image) >= 200){
        
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $name_image.'.jpg';    
            Storage::disk('local')->put("/thumb"."/".year($post->created_at)."/".month($post->created_at)."/".$imageName, base64_decode($image));
            $post->image = $imageName;
        }
        if ($image == "default") {          
            Storage::delete('thumb/'.year($post->created_at).'/'.month($post->created_at).'/'.$post->image);
            $post->image = NULL;
        } 
        $post->save();
        // social
        DB::table("social_posts")->where("id_post", $id)->delete();
        $data_social = array();
        foreach ($request->social as $key => $item) {
            if($item != null) {
                array_push($data_social,[
                    'id_post'=> $id,
                    'id_social'=>$key,
                    'link'=> $item,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ]);
            }
        }
        DB::table('social_posts')->insert($data_social);

        return redirect()->back()->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $post = Post::find($id);
        if ($post ) {
            $post->status = $request->status;
            $post->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $post = Post::find($id);
        $post->sort = $request->sort;
        $post->save();
        return "success";
    }
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            Storage::delete('thumb/'.year($post->created_at).'/'.month($post->created_at).'/'.$post->image);
            DB::table('posts')->where('id', $id)->delete();
            return "success";
        } else {
            return redirect()->back()->with('error','error!');
        }
    }
}
