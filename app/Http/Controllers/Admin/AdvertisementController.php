<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Advertisement;
use App\Models\Standad;

use Illuminate\Support\Str;
class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = DB::table('advertisements')
            ->join('standads','standads.id','=','advertisements.standad')
            ->select('advertisements.*', 'standads.title AS standad')
            ->get();
        return view('admin.advertisement.index',['advertisements'=>$advertisements]);
    }
    public function create()
    {
        $count = Advertisement::count();
        $sort = $count + 1;
        $standads = Standad::where('status',1)->get();
        return view('admin.advertisement.create',['sort'=>$sort,'standads'=>$standads]);
    }
    public function store(Request $request)
    {
        $advertisement = new Advertisement;
        $advertisement->title = $request->title;
        $advertisement->slug = Str::slug($request->title, '-');
        $advertisement->sort = $request->sort;
        $advertisement->standad = $request->standad;
        $advertisement->link = $request->link;
        $advertisement->image = $request->image;
        $advertisement->status = ($request->status == 'on' ? 1 : 0);
        $advertisement->created_at = date("Y-m-d H:i:s");
        $advertisement->updated_at = date("Y-m-d H:i:s");
        $advertisement->save();
        return redirect('admincp/advertisement/'.$advertisement->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $advertisement = Advertisement::find($id);
        $standads = Standad::where('status',1)->get();
        return view('admin.advertisement.edit',['advertisement'=>$advertisement,'standads'=>$standads]);
    }
    public function update(Request $request,$id)
    {
        $advertisement = Advertisement::find($id);     
        $advertisement->title = $request->title;
        $advertisement->slug = Str::slug($request->title, '-');
        $advertisement->sort = $request->sort;
        $advertisement->standad = $request->standad;
        $advertisement->link = $request->link;
        $advertisement->image = $request->image;
        $advertisement->status = ($request->status == 'on' ? 1 : 0);
        $advertisement->updated_at = date("Y-m-d H:i:s");
        $advertisement->save();
        return redirect('admincp/advertisement/'.$advertisement->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $advertisement = Advertisement::find($id);
        if ($advertisement ) {
            $advertisement->status = $request->status;
            $advertisement->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $advertisement = Advertisement::find($id);
        $advertisement->sort = $request->sort;
        $advertisement->save();
        return "success";
    }
    public function destroy($id)
    {
     
        $advertisement = Advertisement::find($id);
        if($advertisement){
            $advertisement->delete();
            return "success";
        }
        return 'error';
    }
}
