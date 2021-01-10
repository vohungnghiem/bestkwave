<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Agency;
use Illuminate\Support\Str;

class AgencyController extends Controller
{
    public function index()
    {
        $agencys = Agency::all();
        return view('admin.agency.index',['agencys'=>$agencys]);
    }
    public function create()
    {
        $count = Agency::count();
        $sort = $count + 1;
        return view('admin.agency.create',['sort'=>$sort]);
    }
    public function store(Request $request)
    {
        $agency = new Agency;
        $agency->title = $request->title;
        $agency->slug = Str::slug($request->title, '-');
        $agency->sort = $request->sort;
        $agency->status = ($request->status == 'on' ? 1 : 0);
        $agency->created_at = date("Y-m-d H:i:s");
        $agency->updated_at = date("Y-m-d H:i:s");
        $agency->save();
        return redirect('admincp/idolplus/agency/'.$agency->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $agency = Agency::find($id);       
        return view('admin.agency.edit',['agency'=>$agency]);
    }
    public function update(Request $request,$id)
    {
        $agency = Agency::find($id);     
        $agency->title = $request->title;
        $agency->slug = Str::slug($request->title, '-');
        $agency->sort = $request->sort;
        $agency->status = ($request->status == 'on' ? 1 : 0);
        $agency->updated_at = date("Y-m-d H:i:s");
        $agency->save();
        return redirect('admincp/idolplus/agency/'.$agency->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $agency = Agency::find($id);
        if ($agency ) {
            $agency->status = $request->status;
            $agency->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $agency = Agency::find($id);
        $agency->sort = $request->sort;
        $agency->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $agency = Agency::find($id);
        if($agency){
            $agency->delete();
            return "success";
        }
        return 'error';
    }
}
