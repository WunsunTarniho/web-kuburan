<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();
            $findUserGoogle = User::where('google_id', $user->id)->first();
            $findEmailUser = User::where('email', $user->email)->first();

            if($findEmailUser){
                $findEmailUser->update(['google_id' => $user->id]);
                Auth::login($findEmailUser);
            }else if($findUserGoogle){
                Auth::login($findUserGoogle);
            }else{
                $newUser = User::create([
                    'google_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => '12345678',
                ]);
                
                Auth::login($newUser);
            }

            return redirect()->intended('/');
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
