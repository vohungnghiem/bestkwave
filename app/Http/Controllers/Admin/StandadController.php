<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Standad;
use Illuminate\Support\Str;

class StandadController extends Controller
{
    public function index()
    {
        $standads = Standad::all();
        return view('admin.standad.index',['standads'=>$standads]);
    }
    public function create()
    {
        $count = Standad::count();
        $sort = $count + 1;
        return view('admin.standad.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $standad = new Standad;
        $standad->title = $request->title;
        $standad->slug = Str::slug($request->title, '-');
        $standad->sort = $request->sort;
        $standad->status = ($request->status == 'on' ? 1 : 0);
        $standad->created_at = date("Y-m-d H:i:s");
        $standad->updated_at = date("Y-m-d H:i:s");
        $standad->save();
        return redirect('admincp/standad/'.$standad->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $standad = Standad::find($id);       
        return view('admin.standad.edit',['standad'=>$standad]);
    }
    public function update(Request $request,$id)
    {
        $standad = Standad::find($id);     
        $standad->title = $request->title;
        $standad->slug = Str::slug($request->title, '-');
        $standad->sort = $request->sort;
        $standad->status = ($request->status == 'on' ? 1 : 0);
        $standad->updated_at = date("Y-m-d H:i:s");
        $standad->save();
        return redirect('admincp/standad/'.$standad->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $standad = Standad::find($id);
        if ($standad ) {
            $standad->status = $request->status;
            $standad->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $standad = Standad::find($id);
        $standad->sort = $request->sort;
        $standad->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $standad = Standad::find($id);
        if($standad){
            $standad->delete();
            return "success";
        }
        return 'error';
    }
}
