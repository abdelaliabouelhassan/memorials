<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    //

    public function getProfiles(){
        $profiles = Profile::where('user_id',auth('sanctum')->id())->where('qrcode_id','!=',null)->get();

        return response()->json($profiles,200);
    }
}
