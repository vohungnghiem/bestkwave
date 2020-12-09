<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index($parent)
    {
        $categories = Category::where('parent',$parent)->orderBy('sort','asc')->orderBy('created_at','asc')->get();
        $root = Category::where('parent',0)->orderBy('sort','asc')->orderBy('created_at','asc')->get();
        return view('admin.category.index',['root'=>$root,'categories'=>$categories,'parent'=>$parent]);
    }
    
    public function create()
    {
        $categories  = Category::where('status',1)->orderBy('sort','asc')->orderBy('created_at','asc')->get();  
        return view('admin.category.create',['categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $category = new Category;
        $category->parent = $request->parent;
        $category->title = $request->title;
        $category->slug = Str::slug($request->title, '-');
        $category->status = ($request->status == 'on' ? 1 : 0);
        $category->created_at = date("Y-m-d H:i:s");
        $category->updated_at = date("Y-m-d H:i:s");
        $category->save();
        return redirect('admincp/category/'.$category->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $category = Category::find($id);       
        $categories = Category::where('status',1)->orderBy('sort','asc')->orderBy('created_at','asc')->get();       
        return view('admin.category.edit',['category'=>$category,'categories'=>$categories ]);
    }
    public function update(Request $request,$id)
    {
        $category = Category::find($id);     
        $check = DB::table('categories')->where('id',$request->parent)->first();
        if (isset($check)) {
            $checkp = $check->parent;
        }else{
            $checkp = 0;
        }
        if ( ($checkp == 0) ) {
            $category->parent = $request->parent;
            $category->title = $request->title;
            $category->slug = Str::slug($request->title, '-');
            $category->status = ($request->status == 'on' ? 1 : 0);
            $category->updated_at = date("Y-m-d H:i:s");
            $category->save();
            return redirect('admincp/category/'.$category->id.'/edit')->with('success','Success !');
        } else {
            return redirect()->back()->with('error','Không được phép!');
        }       
    }
    public function status(Request $request,$id){
        $category = Category::find($id);
        if ($category ) {
            $category->status = $request->status;
            $category->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $item = Category::find($id);
        $item->sort = $request->sort;
        $item->save();
        return "success";
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        $check = Category::where('parent',$id)->count();
        $checkpost = Post::where('category',$id)->count(); 
        if(($check <= 0) && ($checkpost <= 0)){
            $category->delete();
            return "success";
        }else{
            return "error";
        }
    }
}
