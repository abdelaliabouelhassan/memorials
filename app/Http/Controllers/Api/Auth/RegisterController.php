<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

            // event(new Registered($user));

            return response()->json([
                'message' => 'Account created successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
