<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
    
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $finduser = User::where('provider_id', $getInfo->id)->first();
        if($finduser){
            $user = User::find($finduser->id);
            $user->avatar = $getInfo->avatar;
            $user->save(); 
            Auth::login($finduser);
        }else{

            $newUser = new User;
            $newUser->name = $getInfo->name;
            $newUser->email = $getInfo->email;
            $newUser->avatar = $getInfo->avatar;
            $newUser->provider = $provider;
            $newUser->provider_id = $getInfo->id;
            $newUser->save();
        
            Auth::login($newUser);
        }
       
        return redirect()->to(session('backurlsocial'));      
    
    }
    // function createUser($getInfo,$provider){
    
    //     $user = User::where('provider_id', $getInfo->id)->first();
    //     if (isset($user) && ($user != 'null')) {
    //         $user = User::create([
    //             'name'     => $getInfo->name,
    //             'email'    => $getInfo->email,
    //             'avatar'   => $getInfo->avatar,
    //             'provider' => $provider,
    //             'provider_id' => $getInfo->id
    //         ]);
    //     }
    //     return $user;
    // }
}
