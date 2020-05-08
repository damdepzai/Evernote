<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialiteController extends Controller
{
    public function loginGoogle(){
        return Socialite::with('Google')->redirect();
    }
    public function loginGoogleCallback(){
        try {
            $googleUser = Socialite::driver('Google')->user();
        }
        catch (\Exception $e){
            return redirect('/login');
        }
        $systemUser = User::where('email', $googleUser->email)->get()->first();

       if($systemUser){
           $systemUser ->google_id = $googleUser->id;
           $systemUser->save();
       }
       else{
           $systemUser = User::where('google_id', $googleUser->id)->first();
           if ( ! $systemUser ){
               $systemUser = User::create([
                   'name' => $googleUser->user['name'],
                   'email' => $googleUser->user['email'],
                   'google_id' =>  $googleUser->user['id']
               ]);
           }
       }
        Auth::loginUsingId($systemUser->id);
        return redirect()->route('home');
    }
    public function loginFacebook(){
        return Socialite::with('Facebook')->redirect();
    }
    public function loginFacebookCallback(){
        try {
            $facebookUser = Socialite::driver('Facebook')->user();
        }
        catch (\Exception $e){
            return redirect('/login');
        }
        $systemUser = User::where('email', $facebookUser->email)->get()->first();

        if($systemUser){
            $systemUser ->facebook_id = $facebookUser->id;
            $systemUser->save();
        }
        else{
            $systemUser = User::where('facebook_id', $facebookUser->id)->first();
            if ( ! $systemUser ){
                $systemUser = User::create([
                    'name' => $facebookUser->user['name'],
                    'email' => $facebookUser->user['email'],
                    'facebook_id' =>  $facebookUser->user['id']
                ]);
            }
        }
        Auth::loginUsingId($systemUser->id);
        return redirect()->route('home');
    }
}
