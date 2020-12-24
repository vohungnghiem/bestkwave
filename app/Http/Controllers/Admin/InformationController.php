<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Information;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::all();
        return view('admin.information.index',['informations'=>$informations]);
    }
    public function create()
    {
        $count = Information::count();
        $sort = $count + 1;
        return view('admin.information.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $information = new Information;
        $information->title = $request->title;
        $information->slug = Str::slug($request->title, '-');
        $information->sort = $request->sort;
        $information->link = $request->link;
        $information->type = $request->type;
        $information->status = ($request->status == 'on' ? 1 : 0);
        $information->created_at = date("Y-m-d H:i:s");
        $information->updated_at = date("Y-m-d H:i:s");
        $information->save();
        return redirect('admincp/information/'.$information->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $information = Information::find($id);       
        return view('admin.information.edit',['information'=>$information]);
    }
    public function update(Request $request,$id)
    {
        $information = Information::find($id);     
        $information->title = $request->title;
        $information->slug = Str::slug($request->title, '-');
        $information->sort = $request->sort;
        $information->link = $request->link;
        $information->type = $request->type;
        $information->status = ($request->status == 'on' ? 1 : 0);
        $information->updated_at = date("Y-m-d H:i:s");
        $information->save();
        return redirect('admincp/information/'.$information->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $information = Information::find($id);
        if ($information ) {
            $information->status = $request->status;
            $information->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $information = Information::find($id);
        $information->sort = $request->sort;
        $information->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $information = Information::find($id);
        if($information){
            $information->delete();
            return "success";
        }
        return 'error';
    }
}
