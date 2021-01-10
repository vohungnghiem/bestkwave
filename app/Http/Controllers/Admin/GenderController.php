<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;
use Illuminate\Support\Str;

class GenderController extends Controller
{
    public function index()
    {
        $genders = Gender::all();
        return view('admin.gender.index',['genders'=>$genders]);
    }
    public function create()
    {
        $count = Gender::count();
        $sort = $count + 1;
        return view('admin.gender.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $gender = new Gender;
        $gender->title = $request->title;
        $gender->slug = Str::slug($request->title, '-');
        $gender->sort = $request->sort;
        $gender->status = ($request->status == 'on' ? 1 : 0);
        $gender->created_at = date("Y-m-d H:i:s");
        $gender->updated_at = date("Y-m-d H:i:s");
        $gender->save();
        return redirect('admincp/idolplus/gender/'.$gender->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $gender = Gender::find($id);       
        return view('admin.gender.edit',['gender'=>$gender]);
    }
    public function update(Request $request,$id)
    {
        $gender = Gender::find($id);     
        $gender->title = $request->title;
        $gender->slug = Str::slug($request->title, '-');
        $gender->sort = $request->sort;
        $gender->status = ($request->status == 'on' ? 1 : 0);
        $gender->updated_at = date("Y-m-d H:i:s");
        $gender->save();
        return redirect('admincp/idolplus/gender/'.$gender->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $gender = Gender::find($id);
        if ($gender ) {
            $gender->status = $request->status;
            $gender->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $gender = Gender::find($id);
        $gender->sort = $request->sort;
        $gender->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $gender = Gender::find($id);
        if($gender){
            $gender->delete();
            return "success";
        }
        return 'error';
    }
}
