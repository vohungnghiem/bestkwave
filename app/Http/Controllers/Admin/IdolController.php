<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Idol;
use App\Models\Profession;
use App\Models\Gender;
use App\Models\Gallery;
use Illuminate\Support\Str;

class IdolController extends Controller
{
    public function index()
    {
        $idols = Idol::orderByDesc('id')
            ->get();
        return view('admin.idol.index',['idols'=>$idols]);
    }
    
    public function create()
    {
        $professions = Profession::all();
        $genders = Gender::all();
        return view('admin.idol.create',['professions'=>$professions,'genders'=>$genders]);
    }
    
    public function store(Request $request)
    {

        $id_latest = Idol::latest()->first();
        $id_id = $id_latest ? ($id_latest->id + 1) : 1;  
        $idol = new Idol;
        $idol->name = $request->name;
        $idol->nickname = $request->nickname;
        $idol->agency_name = $request->agency_name;
        $idol->group_name = $request->group_name;
        $idol->profession_id = $request->profession_id;
        if ($request->birthday && ($request->birthday != 'null')) {
            $idol->birthday = date_create_from_format("d/m/Y", $request->birthday)->format("Y-m-d");
        }else {
            $idol->birthday = null;
        }
        $idol->gender_id = $request->gender_id;
        $idol->nature = $request->nature;
        $idol->weight = $request->weight;
        $idol->height = $request->height;
        $idol->sort = 0;
        $idol->status = ($request->status == 'on' ? 1 : 0);
        $idol->created_at = date("Y-m-d H:i:s");
        $idol->updated_at = date("Y-m-d H:i:s");

        // image
        $image = $request->avatar;         
        $name_image = $id_id; // name image get id
        if (strlen($image) >= 200){
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $name_image . '.jpg';    
            Storage::disk('local')->put("/idol"."/".year($idol->created_at)."/".month($idol->created_at)."/".$imageName, base64_decode($image));
            $idol->avatar = $imageName;
        }
        if ($image == "default") {          
            Storage::delete('idol/'.year($idol->created_at).'/'.month($idol->created_at).'/'.$idol->avatar);
            $idol->avatar = NULL;
        }
        $idol->save();
        if ($request->gallery) {
            foreach ($request->gallery as $key => $item) {
                DB::table('gallery_idols')->insert([
                    'idol_id' => $idol->id,
                    'gallery_id' => $key,
                    'image' => $item
                ]);
            }
        }
        return redirect('admincp/idol/'.$idol->id.'/edit')->with('success','Success !');
        
        
    }
    public function edit($id)
    {        
        $idol = Idol::find($id);  
        $professions = Profession::all();
        $genders = Gender::all();
        $gallery = Gallery::all();
        return view('admin.idol.edit',['idol'=>$idol,'professions'=>$professions,'genders'=>$genders,'gallery'=>$gallery]);
    }
    public function update(Request $request,$id)
    {   
        $idol = Idol::find($id);   
        $id_id = $idol->id;  
        $idol->name = $request->name;
        $idol->nickname = $request->nickname;
        $idol->agency_name = $request->agency_name;
        $idol->group_name = $request->group_name;
        $idol->profession_id = $request->profession_id;
        if ($request->birthday && ($request->birthday != 'null')) {
            $idol->birthday = date_create_from_format("d/m/Y", $request->birthday)->format("Y-m-d");
        }else {
            $idol->birthday = null;
        }
        $idol->gender_id = $request->gender_id;
        $idol->nature = $request->nature;
        $idol->weight = $request->weight;
        $idol->height = $request->height;
        $idol->status = ($request->status == 'on' ? 1 : 0);
        $idol->updated_at = date("Y-m-d H:i:s");

        $image = $request->avatar;         
        $name_image = $id_id;
        if (strlen($image) >= 200){
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = $name_image.'.jpg';    
            Storage::disk('local')->put("/idol"."/".year($idol->created_at)."/".month($idol->created_at)."/".$imageName, base64_decode($image));
            $idol->avatar = $imageName;
        }
        if ($image == "default") {          
            Storage::delete('idol/'.year($idol->created_at).'/'.month($idol->created_at).'/'.$idol->avatar);
            $idol->avatar = NULL;
        } 
        $idol->save();
        DB::table('gallery_idols')->where('idol_id',$id)->delete();
        if ($request->gallery) {
            foreach ($request->gallery as $key => $item) {
                DB::table('gallery_idols')->insert([
                    'idol_id' => $id,
                    'gallery_id' => $key,
                    'image' => $item
                ]);
            }
        }

        return redirect()->back()->with('success','Success !'); 
    }

    public function status(Request $request,$id){
        $idol = Idol::find($id);
        if ($idol) {
            $idol->status = $request->status;
            $idol->save();
            return $request->status;
        } else {
            return "error";
        }
    }
    public function sort(Request $request,$id){
        $idol = Idol::find($id);
        $idol->sort = $request->sort;
        $idol->save();
        return "success";
    }
    public function destroy($id)
    {
        $idol = Idol::find($id);
        if ($idol) {
            Storage::delete('idol/'.year($idol->created_at).'/'.month($idol->created_at).'/'.$idol->image);
            DB::table('idols')->where('id', $id)->delete();
            return "success";
        } else {
            return redirect()->back()->with('error','error!');
        }
    }
}
