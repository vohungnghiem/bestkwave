<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Str;
class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::all();
        return view('admin.social.index',['socials'=>$socials]);
    }
    public function create()
    {
        $count = Social::count();
        $sort = $count + 1;
        return view('admin.social.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $social = new social;
        $social->title = $request->title;
        $social->slug = Str::slug($request->title, '-');
        $social->sort = $request->sort;
        $social->status = ($request->status == 'on' ? 1 : 0);
        $social->created_at = date("Y-m-d H:i:s");
        $social->updated_at = date("Y-m-d H:i:s");
        $social->save();
        return redirect('admincp/social/'.$social->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $social = social::find($id);       
        return view('admin.social.edit',['social'=>$social]);
    }
    public function update(Request $request,$id)
    {
        $social = social::find($id);     
        $social->title = $request->title;
        $social->slug = Str::slug($request->title, '-');
        $social->sort = $request->sort;
        $social->status = ($request->status == 'on' ? 1 : 0);
        $social->updated_at = date("Y-m-d H:i:s");
        $social->save();
        return redirect('admincp/social/'.$social->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $social = social::find($id);
        if ($social ) {
            $social->status = $request->status;
            $social->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $social = social::find($id);
        $social->sort = $request->sort;
        $social->save();
        return "success";
    }
    public function destroy($id)
    {
       
        $social = social::find($id);
       
        if($social){
            $social->delete();
            return "success";
        }else{
            return "error";
        }
    }
}
