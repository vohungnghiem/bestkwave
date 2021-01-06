<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
class SocialController extends Controller
{
    public function redirect($provider)
    {
        echo Socialite::driver('zalo')->redirect();
        exit();
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
            
        $getInfo = Socialite::driver($provider)->user();
        $finduser = User::where('provider_id', $getInfo->id)->first();

        if($finduser){
            Auth::login($finduser);
        }else{
            $newUser = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
            Auth::login($newUser);
        }

        // auth()->login($user);
    
        return redirect()->to('idol/detail');
    
    }
    function createUser($getInfo,$provider){
    
        $user = User::where('provider_id', $getInfo->id)->first();
        if (isset($user) && ($user != 'null')) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
