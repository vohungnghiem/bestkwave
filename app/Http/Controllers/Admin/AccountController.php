<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Str; 
class AccountController extends Controller
{
    public function level(){
        return Auth::user()->level;
    }
    public function levelcheck($email) {
        if ((Auth::user()->level == 1) || Auth::user()->email == $email ) {
            return 'checked';
        }
    }
    public function index()
    {
        $accounts = DB::table('users')->get();
        return view('admin.account.index',['accounts'=>$accounts]);
    }
    public function create()
    {
        if ($this->level() == 1) {
            return view('admin.account.create');
        }else{
            return redirect()->back()->with('error','Tài khoản không có quyền tạo!');
        }
    }
    public function store(AccountRequest $request)
    {
        if ($this->level() == 1) {
            $account = new User;
            $account->name = $request->name;
            $account->email = $request->email;
            $account->password = bcrypt($request->password);
            $account->level = $request->level;
            $account->phone = $request->phone;    
            $account->status = ($request->status == 'on' ? 1 : 0);
            $account->created_at = date("Y-m-d H:i:s");
            $account->updated_at = date("Y-m-d H:i:s");
            $account->save();
            // avatar
            $image = $request->avatar;         
            $name_image = Str::slug($request->email, '-');
            if (strlen($image) >= 100){
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $name_image . '.jpg';    
                Storage::disk('local')->put("/account"."/".year($account->created_at)."/".month($account->created_at)."/".$imageName, base64_decode($image));
                $account->avatar = $imageName;
            }
            if ($image == "default") {          
                Storage::delete('account/'.year($account->created_at).'/'.month($account->created_at).'/'.$account->avatar);
                $account->avatar = NULL;
            }
            $account->save();

            return redirect('admincp/account/'.$account->id.'/edit')->with('success','Success !');
           
        }else{
            return redirect()->back()->with('error','Tài khoản không có quyền tạo!');
        }
    }

    public function edit($id)
    {        
        $account = User::find($id);       
        if ($this->levelcheck($account->email) == "checked" ) {
            return view('admin.account.edit',['account'=>$account]);
        } else {
            return redirect()->back()->with('error','Tài khoản không có quyền chỉnh sửa!');
        }
    }

    public function update(AccountRequest $request, $id)
    {
        $account = User::find($id);
        if ($this->levelcheck($account->email) == "checked" ) {
            $account->name = $request->name;
            if ($request->email != $request->oldemail) {
                $account->email = $request->email;
            }
            if ($request->password != null) {
                $account->password = bcrypt($request->password);
            }
            $account->level = $request->level;
            $account->phone = $request->phone;
            // avatar
            $image = $request->avatar;         
            $name_image = Str::slug($request->email, '-');
        
            if (strlen($image) >= 100){
            
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $name_image.'.jpg';    
                Storage::disk('local')->put("/account"."/".year($account->created_at)."/".month($account->created_at)."/".$imageName, base64_decode($image));
                $account->avatar = $imageName;
            }
            if ($image == "default") {          
                Storage::delete('account/'.year($account->created_at).'/'.month($account->created_at).'/'.$account->avatar);
                $account->avatar = NULL;
            }  
            $account->status = ($request->status == 'on' ? 1 : 0);
            $account->updated_at = date("Y-m-d H:i:s");

            $account->save();
            
            return redirect('admincp/account/'.$id.'/edit')->with('success','Success !');
        } else {
            return redirect()->back()->with('error','Tài khoản không có quyền chỉnh sửa!');
        }
    }

    public function status(Request $request,$id){
        if($id == 1){
            return "error";
        }else{
            $account = User::find($id);
            if ($this->levelcheck($account->email) == "checked" ) {
                $account->status = $request->status;
                $account->save();
                return $request->status;
            } else {
                return "error";
            }
        }
    }
    public function destroy($id)
    {
        $account = User::find($id);
        if ($this->level() == 1) {
            if($id == 1){
                return "error";
            }else{
                Storage::delete('account/'.year($account->created_at).'/'.month($account->created_at).'/'.$account->avatar);
                DB::table('users')->where('id', $id)->delete();
                
                return "success";
            }
        } else {
            return redirect()->back()->with('error','Tài khoản không có quyền xóa!');
        }
        
    }
}
