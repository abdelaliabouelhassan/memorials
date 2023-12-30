<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //

    public function Login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised, Wrong email or password'], 401);
        }
    }


    public function Logout(){
        Auth::logout();

        return response()->json(['message' => 'log out'], 200);
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        
        $user = Socialite::driver('google')->user();

        //if user is not registered, register them

        //if user is registered, log them in

        //return redirect to home page
        $referral_code = Str::random(6) . '' . time() . Str::random(6);
        $checkuser = User::where('email', $user->email)->first();


        if(!$checkuser){
            $checkuser = User::create([
                'first_name' => $user->user['given_name'],
                'last_name' => $user->user['family_name'],
                'email' => $user->email,
                'password' => Hash::make($user->token . Str::random(5)),
                'email_verified_at' => now(),
                'referral_code' =>$referral_code,
            ]);

         
        }

        Auth::login($checkuser, true);

        $token = auth()->user()->createToken('authToken')->plainTextToken;
       

        return redirect()->route('social-login',['token'=>$token]);
    }
}
