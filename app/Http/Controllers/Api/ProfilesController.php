<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfilesController extends Controller
{
    //

    public function getProfiles()
    {
        $profiles = Profile::where('user_id', auth('sanctum')->id())->where('qrcode_id', '!=', null)->get();

        return response()->json($profiles, 200);
    }


    public function ProfileDetailsStore(Request $request,$id)
    {
        $request->validate([
            'image' => 'required',
            'fullname' => 'required|min:2',
            'residence' => 'required',
            'religious' => 'required',
            'birthday' => 'required',
            'death' =>  'required',
            'description' => 'required|min:50'
        ]);


       $profile =  Profile::findOrFail($id);

       if($profile->user_id == auth('sanctum')->id()){
        $profile->fullname = $request->fullname;
        $profile->residence = $request->residence;
        $profile->religious = $request->religious;
        $profile->birthday = $request->birthday;
        $profile->death = $request->death;
        $profile->description = $request->description;
        $profile->profession = $request->profession;
        $profile->miscellaneous = $request->miscellaneous;
        if($profile->image != $request->image){
            $oldImage = $profile->image;
            $profile->image  =  $this->uploadImage('uploads/profiles/', $request->image,$oldImage);
        }
        
        $profile->save();
       }else{
        return abort(404);
       }


        return response()->json(['message' => 'Step one saved successfully']);
    }


    private function uploadImage($path, $base64Data,$oldImage = null)
    {

        try {

            if($oldImage != null){
                $oldImage = ltrim($oldImage, '/');
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $ext = substr($base64Data, strpos($base64Data, '/') + 1);
            $ext = substr($ext, 0, strpos($ext, ';'));

            $filename = Str::random(20) . time() . '.' . $ext;

            // Define the path where you want to store the file
            $filePath = $path . $filename;
            $fileContents = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Data));
            // Save the file using file_put_contents
            file_put_contents($filePath, $fileContents);
            return '/' . $filePath;
        } catch (Exception $e) {
            Log::error($e);
        }
    }


    public function ProfileDetails($id) {
        $profile = Profile::findOrFail($id);
        if($profile->user_id == auth('sanctum')->id()){
            return response()->json($profile,200);
        }

        return abort(404);
    }
}
