<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubSend;
use Illuminate\Support\Str;

class SubSendController extends Controller
{
    public function index()
    {
        $subsends = SubSend::all();
        return view('admin.subsend.index',['subsends'=>$subsends]);
    }
    public function create()
    {
        $count = SubSend::count();
        $sort = $count + 1;
        return view('admin.subsend.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $subsend = new SubSend;
        $subsend->title = $request->title;
        $subsend->slug = Str::slug($request->title, '-');
        $subsend->sort = $request->sort;
        $subsend->status = ($request->status == 'on' ? 1 : 0);
        $subsend->created_at = date("Y-m-d H:i:s");
        $subsend->updated_at = date("Y-m-d H:i:s");
        $subsend->save();
        return redirect('admincp/sub/subsend/'.$subsend->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $subsend = SubSend::find($id);       
        return view('admin.subsend.edit',['subsend'=>$subsend]);
    }
    public function update(Request $request,$id)
    {
        $subsend = SubSend::find($id);     
        $subsend->title = $request->title;
        $subsend->slug = Str::slug($request->title, '-');
        $subsend->sort = $request->sort;
        $subsend->status = ($request->status == 'on' ? 1 : 0);
        $subsend->updated_at = date("Y-m-d H:i:s");
        $subsend->save();
        return redirect('admincp/sub/subsend/'.$subsend->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $subsend = SubSend::find($id);
        if ($subsend ) {
            $subsend->status = $request->status;
            $subsend->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $subsend = SubSend::find($id);
        $subsend->sort = $request->sort;
        $subsend->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $subsend = SubSend::find($id);
        if($subsend){
            $subsend->delete();
            return "success";
        }
        return 'error';
    }
}
