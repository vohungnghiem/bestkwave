<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use Illuminate\Support\Str;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::all();
        return view('admin.profession.index',['professions'=>$professions]);
    }
    public function create()
    {
        $count = Profession::count();
        $sort = $count + 1;
        return view('admin.profession.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $profession = new Profession;
        $profession->title = $request->title;
        $profession->slug = Str::slug($request->title, '-');
        $profession->sort = $request->sort;
        $profession->status = ($request->status == 'on' ? 1 : 0);
        $profession->created_at = date("Y-m-d H:i:s");
        $profession->updated_at = date("Y-m-d H:i:s");
        $profession->save();
        return redirect('admincp/idolplus/profession/'.$profession->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $profession = Profession::find($id);       
        return view('admin.profession.edit',['profession'=>$profession]);
    }
    public function update(Request $request,$id)
    {
        $profession = Profession::find($id);     
        $profession->title = $request->title;
        $profession->slug = Str::slug($request->title, '-');
        $profession->sort = $request->sort;
        $profession->status = ($request->status == 'on' ? 1 : 0);
        $profession->updated_at = date("Y-m-d H:i:s");
        $profession->save();
        return redirect('admincp/idolplus/profession/'.$profession->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $profession = Profession::find($id);
        if ($profession ) {
            $profession->status = $request->status;
            $profession->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $profession = Profession::find($id);
        $profession->sort = $request->sort;
        $profession->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $profession = Profession::find($id);
        if($profession){
            $profession->delete();
            return "success";
        }
        return 'error';
    }
}
