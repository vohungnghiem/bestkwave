<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TypePost;
use App\Models\Post;
use Illuminate\Support\Str;
class TypePostController extends Controller
{
    public function index()
    {
        $typeposts = TypePost::all();
        return view('admin.typepost.index',['typeposts'=>$typeposts]);
    }
    public function create()
    {
        $count = TypePost::count();
        $sort = $count + 1;
        return view('admin.typepost.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $typepost = new TypePost;
        $typepost->title = $request->title;
        $typepost->slug = Str::slug($request->title, '-');
        $typepost->sort = $request->sort;
        $typepost->status = ($request->status == 'on' ? 1 : 0);
        $typepost->created_at = date("Y-m-d H:i:s");
        $typepost->updated_at = date("Y-m-d H:i:s");
        $typepost->save();
        return redirect('admincp/typepost/'.$typepost->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $typepost = TypePost::find($id);       
        return view('admin.typepost.edit',['typepost'=>$typepost]);
    }
    public function update(Request $request,$id)
    {
        $typepost = TypePost::find($id);     
        $typepost->title = $request->title;
        $typepost->slug = Str::slug($request->title, '-');
        $typepost->sort = $request->sort;
        $typepost->status = ($request->status == 'on' ? 1 : 0);
        $typepost->updated_at = date("Y-m-d H:i:s");
        $typepost->save();
        return redirect('admincp/typepost/'.$typepost->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $typepost = TypePost::find($id);
        if ($typepost ) {
            $typepost->status = $request->status;
            $typepost->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $typepost = TypePost::find($id);
        $typepost->sort = $request->sort;
        $typepost->save();
        return "success";
    }
    public function destroy($id)
    {
        if ($id <= 2) {
            return "error";
        }
        $typepost = TypePost::find($id);
        $check = Post::where('type_post',$id)->count();
        if($check <= 0){
            $typepost->delete();
            return "success";
        }else{
            return "error";
        }
    }
}
