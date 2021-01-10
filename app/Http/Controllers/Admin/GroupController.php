<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('admin.group.index',['groups'=>$groups]);
    }
    public function create()
    {
        $count = Group::count();
        $sort = $count + 1;
        return view('admin.group.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $group = new Group;
        $group->title = $request->title;
        $group->slug = Str::slug($request->title, '-');
        $group->sort = $request->sort;
        $group->status = ($request->status == 'on' ? 1 : 0);
        $group->created_at = date("Y-m-d H:i:s");
        $group->updated_at = date("Y-m-d H:i:s");
        $group->save();
        return redirect('admincp/idolplus/group/'.$group->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $group = Group::find($id);       
        return view('admin.group.edit',['group'=>$group]);
    }
    public function update(Request $request,$id)
    {
        $group = Group::find($id);     
        $group->title = $request->title;
        $group->slug = Str::slug($request->title, '-');
        $group->sort = $request->sort;
        $group->status = ($request->status == 'on' ? 1 : 0);
        $group->updated_at = date("Y-m-d H:i:s");
        $group->save();
        return redirect('admincp/idolplus/group/'.$group->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $group = Group::find($id);
        if ($group ) {
            $group->status = $request->status;
            $group->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $group = Group::find($id);
        $group->sort = $request->sort;
        $group->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $group = Group::find($id);
        if($group){
            $group->delete();
            return "success";
        }
        return 'error';
    }
}
