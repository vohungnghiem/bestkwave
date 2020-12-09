<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubReceive;
use Illuminate\Support\Str;

class SubReceiveController extends Controller
{
    public function index()
    {
        $subreceives = SubReceive::all();
        return view('admin.subreceive.index',['subreceives'=>$subreceives]);
    }
    public function create()
    {
        $count = SubReceive::count();
        $sort = $count + 1;
        return view('admin.subreceive.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $subreceive = new SubReceive;
        $subreceive->title = $request->title;
        $subreceive->slug = Str::slug($request->title, '-');
        $subreceive->sort = $request->sort;
        $subreceive->status = ($request->status == 'on' ? 1 : 0);
        $subreceive->created_at = date("Y-m-d H:i:s");
        $subreceive->updated_at = date("Y-m-d H:i:s");
        $subreceive->save();
        return redirect('admincp/sub/subreceive/'.$subreceive->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $subreceive = SubReceive::find($id);       
        return view('admin.subreceive.edit',['subreceive'=>$subreceive]);
    }
    public function update(Request $request,$id)
    {
        $subreceive = SubReceive::find($id);     
        $subreceive->title = $request->title;
        $subreceive->slug = Str::slug($request->title, '-');
        $subreceive->sort = $request->sort;
        $subreceive->status = ($request->status == 'on' ? 1 : 0);
        $subreceive->updated_at = date("Y-m-d H:i:s");
        $subreceive->save();
        return redirect('admincp/sub/subreceive/'.$subreceive->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $subreceive = SubReceive::find($id);
        if ($subreceive ) {
            $subreceive->status = $request->status;
            $subreceive->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $subreceive = SubReceive::find($id);
        $subreceive->sort = $request->sort;
        $subreceive->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $subreceive = SubReceive::find($id);
        if($subreceive){
            $subreceive->delete();
            return "success";
        }
        return 'error';
    }
}
