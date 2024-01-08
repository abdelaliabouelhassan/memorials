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
            $token = auth('sanctum')->user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised, Wrong email or password'], 401);
        }
    }


    public function Logout(){
        Auth::logout();
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
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
                'name' => $user->name,
                'first_name' => $user->user['given_name'],
                'last_name' => $user->user['family_name'],
                'email' => $user->email,
                'password' => Hash::make($user->token . Str::random(5)),
                'email_verified_at' => now(),
                'referral_code' =>$referral_code,
            ]);

         
        }

        Auth::login($checkuser, true);

        $token = auth('sanctum')->user()->createToken('authToken')->plainTextToken;
       

        return redirect()->route('social-login',['token'=>$token]);
    }


    public function redirectToTwitter(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback(){
       
        $user = Socialite::driver('twitter')->user();
      
        $referral_code = Str::random(6) . '' . time() . Str::random(6);
        $checkuser = User::where('email', $user->email)->first();
   
        $nameParts = explode(' ', $user->name);

        // Extract the first name and last name
        $firstName = $nameParts[0];
        $lastName = end($nameParts);

        if(!$checkuser){
            $checkuser = User::create([
                'name' => $user->name,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->email,
                'password' => Hash::make($user->token . Str::random(5)),
                'email_verified_at' => now(),
                // 'avatar' => $user->avatar_original,
                'referral_code' =>$referral_code,
            ]);

         
        }

        Auth::login($checkuser, true);

        $token = auth('sanctum')->user()->createToken('authToken')->plainTextToken;
       

        return redirect()->route('social-login',['token'=>$token]);
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
       
        $user = Socialite::driver('facebook')->user();
      
        $referral_code = Str::random(6) . '' . time() . Str::random(6);
        $checkuser = User::where('email', $user->email)->first();
   
        $nameParts = explode(' ', $user->name);

        // Extract the first name and last name
        $firstName = $nameParts[0];
        $lastName = end($nameParts);
        if(!$checkuser){
            $checkuser = User::create([
                'name' => $user->name,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $user->email,
                'password' => Hash::make($user->token . Str::random(5)),
                'email_verified_at' => now(),
                // 'avatar' => $user->avatar_original,
                'referral_code' =>$referral_code,
            ]);

         
        }

        Auth::login($checkuser, true);

        $token = auth('sanctum')->user()->createToken('authToken')->plainTextToken;
       

        return redirect()->route('social-login',['token'=>$token]);
    }
}
