<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //

    public function Register(Request $request) {
        $request->validate([
            'first_name' => 'required|min:2|max:15',
            'last_name' => 'required|min:2|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
       
       try {
          
             $referral_code = Str::random(6) . '' . time() . Str::random(6);
             $user = User::create([
                'name' =>  $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'referral_code' =>$referral_code,
            ]);

            Auth::login($user, true);

            $token = auth('sanctum')->user()->createToken('authToken')->plainTextToken;

            
            event(new Registered($user));
            
          
            return response()->json([
                'message' => 'Account created successfully',
                'token' => $token
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function SendEmail(Request $request){
        $user = auth('sanctum')->user();
        event(new Registered($user));
        return response()->json("email sent successfully",200);
    }
}
