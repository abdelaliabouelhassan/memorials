<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
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


    public function ProfileDetailsStore(Request $request, $id)
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

        if ($profile->user_id == auth('sanctum')->id()) {
            $profile->fullname = $request->fullname;
            $profile->residence = $request->residence;
            $profile->religious = $request->religious;
            $profile->birthday = $request->birthday;
            $profile->death = $request->death;
            $profile->description = $request->description;
            $profile->profession = $request->profession;
            $profile->miscellaneous = $request->miscellaneous;
            if ($profile->image != $request->image) {
                $oldImage = $profile->image;
                $profile->image  =  $this->uploadImage('uploads/profiles/', $request->image, $oldImage);
            }

            $profile->save();
        } else {
            return abort(404);
        }


        return response()->json(['message' => 'Step one saved successfully']);
    }


    private function uploadImage($path, $base64Data, $oldImage = null)
    {

        try {

            if ($oldImage != null) {
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


    public function ProfileMediaStore(Request $request, $id)
    {



        $profile =  Profile::findOrFail($id);
        $files = $request->images;
        if ($profile->user_id == auth('sanctum')->id()) {
            foreach ($files as $file) {
                $media = Media::where('path', $file['src'])->first();
                if(!$media){
                    $media = new Media();
                    $media->path = $this->uploadImage('uploads/media/', $file['src']);
                    $media->type = $file['type'];
                    $media->profile_id = $id;
                    $media->save();
                }
                
            }
            return response()->json(['message' => 'Step one saved successfully']);
        }

        return abort(404);
    }

    public function ProfileMediaDelete(Request $request, $id)
    {
       
        $profile =  Profile::findOrFail($id);

        if ($profile->user_id == auth('sanctum')->id()) {

            $path = $request->path;

            $media = Media::where('path', $path)->first();

            if ($media && $media->path == $path) {
                $path = ltrim($path, '/');
                if (file_exists($path)) {
                    unlink($path);
                    
                }
                $media->delete();
                
            }




            return response()->json(['message' => 'Step one saved successfully']);
        }

        return abort(404);
    }

    public function ProfileDetails($id)
    {
        $profile = Profile::findOrFail($id);
        if ($profile->user_id == auth('sanctum')->id()) {
            return response()->json($profile, 200);
        }

        return abort(404);
    }


    public function ProfileMedia($id)
    {
        $profile = Profile::findOrFail($id);
        if ($profile->user_id == auth('sanctum')->id()) {
            $media = Media::where('profile_id', $id)->get();
            return response()->json($media, 200);
        }

        return abort(404);
    }
}
