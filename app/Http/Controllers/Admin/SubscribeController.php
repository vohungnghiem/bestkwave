<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Models\SubReceive;
use App\Models\SubSend;
use App\Models\SubJob;
use Illuminate\Support\Str;
class SubscribeController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::all();
        return view('admin.subscribe.index',['subscribes'=>$subscribes]);
    }
    public function create()
    {
        $subsends = SubSend::where('status',1)->get();
        $subreceives = SubReceive::where('status',1)->get();
        $subjobs = SubJob::where('status',1)->get();
        return view('admin.subscribe.create',['subsends'=>$subsends,'subreceives'=>$subreceives,'subjobs'=>$subjobs]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|unique:subscribes'
        ],[
            'name.required' => 'Tên không để trống',
            'name.min' => 'Tên dưới dưới 3 ký tự',
            'email.unique' => 'Bạn đã đăng ký rồi!'
        ]);

        $subscribe = new Subscribe;
        $subscribe->name = $request->name;
        $subscribe->birthday = $request->birthday;
        $subscribe->email = $request->email;
        $subscribe->receive = $request->receive;
        $subscribe->address = $request->address;
        $subscribe->message = $request->message;
        $subscribe->job = $request->job;
        $subscribe->send = $request->send;
        $subscribe->status = 0;
        $subscribe->created_at = date("Y-m-d H:i:s");
        $subscribe->updated_at = date("Y-m-d H:i:s");
        $subscribe->save();
        return redirect('admincp/subscribe/'.$subscribe->id.'/edit')->with('success','Success !');
    }
    public function edit($id)
    {        
        $subscribe = subscribe::find($id);       
        $subsends = SubSend::where('status',1)->get();
        $subreceives = SubReceive::where('status',1)->get();
        $subjobs = SubJob::where('status',1)->get();
        return view('admin.subscribe.edit',['subscribe'=>$subscribe,'subsends'=>$subsends,'subreceives'=>$subreceives,'subjobs'=>$subjobs]);
    }
    public function update(Request $request,$id)
    {
        $subscribe = subscribe::find($id);     
        $subscribe->name = $request->name;
        $subscribe->birthday = $request->birthday;
        $subscribe->email = $request->email;
        $subscribe->receive = $request->receive;
        $subscribe->address = $request->address;
        $subscribe->message = $request->message;
        $subscribe->job = $request->job;
        $subscribe->send = $request->send;
        // $subscribe->status = 1;
        // $subscribe->created_at = date("Y-m-d H:i:s");
        $subscribe->updated_at = date("Y-m-d H:i:s");
        $subscribe->save();
        return redirect('admincp/subscribe/'.$subscribe->id.'/edit')->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $subscribe = subscribe::find($id);
        if ($subscribe ) {
            $subscribe->status = $request->status;
            $subscribe->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $subscribe = subscribe::find($id);
        $subscribe->sort = $request->sort;
        $subscribe->save();
        return "success";
    }
    public function destroy($id)
    {
       
        $subscribe = subscribe::find($id);
       
        if($subscribe){
            $subscribe->delete();
            return "success";
        }else{
            return "error";
        }
    }
}
