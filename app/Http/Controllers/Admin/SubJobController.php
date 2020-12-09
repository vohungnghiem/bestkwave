<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subjob;
use Illuminate\Support\Str;

class SubjobController extends Controller
{
    public function index()
    {
        $subjobs = Subjob::all();
        return view('admin.subjob.index',['subjobs'=>$subjobs]);
    }
    public function create()
    {
        $count = Subjob::count();
        $sort = $count + 1;
        return view('admin.subjob.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $subjob = new Subjob;
        $subjob->title = $request->title;
        $subjob->slug = Str::slug($request->title, '-');
        $subjob->sort = $request->sort;
        $subjob->status = ($request->status == 'on' ? 1 : 0);
        $subjob->created_at = date("Y-m-d H:i:s");
        $subjob->updated_at = date("Y-m-d H:i:s");
        $subjob->save();
        return redirect('admincp/sub/subjob/'.$subjob->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $subjob = Subjob::find($id);       
        return view('admin.subjob.edit',['subjob'=>$subjob]);
    }
    public function update(Request $request,$id)
    {
        $subjob = Subjob::find($id);     
        $subjob->title = $request->title;
        $subjob->slug = Str::slug($request->title, '-');
        $subjob->sort = $request->sort;
        $subjob->status = ($request->status == 'on' ? 1 : 0);
        $subjob->updated_at = date("Y-m-d H:i:s");
        $subjob->save();
        return redirect('admincp/sub/subjob/'.$subjob->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $subjob = Subjob::find($id);
        if ($subjob ) {
            $subjob->status = $request->status;
            $subjob->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $subjob = Subjob::find($id);
        $subjob->sort = $request->sort;
        $subjob->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $subjob = Subjob::find($id);
        if($subjob){
            $subjob->delete();
            return "success";
        }
        return 'error';
    }
}
