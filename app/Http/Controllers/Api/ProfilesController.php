<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Profile;
use App\Models\QrCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfilesController extends Controller
{
    //

    public function getProfiles()
    {
        $profiles = Profile::where('user_id', auth('sanctum')->id())->where('qrcode_id', '!=', null)->with('qrcode')->get();

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
            $profile->step_one_completed = true;
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
            if ($this->getMediaType($ext) == 'image') {
                $fileContents = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Data));
            } else if ('video') {
                $fileContents = base64_decode(preg_replace('#^data:video/\w+;base64,#i', '', $base64Data));
            } else {
                throw new Exception('Unable to determine file extension.');
            }


            // Save the file using file_put_contents
            file_put_contents($filePath, $fileContents);
            return '/' . $filePath;
        } catch (Exception $e) {
            Log::error($e);
        }
    }

    private function getMediaType($extension)
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
        $videoExtensions = ['mp4', 'avi', 'mkv', 'mov', 'wmv'];

        if (in_array(strtolower($extension), $imageExtensions)) {
            return 'image';
        } elseif (in_array(strtolower($extension), $videoExtensions)) {
            return 'video';
        } else {
            return 'unknown';
        }
    }


    public function ProfileMediaStore(Request $request, $id)
    {

        $profile =  Profile::findOrFail($id);
        $files = $request->images;
        if ($profile->user_id == auth('sanctum')->id()) {
            foreach ($files as $file) {

                if (strlen($file['src']) > 50) {
                    $media = new Media();
                    $media->path = $this->uploadImage('uploads/media/', $file['src']);
                    $media->type = $file['type'];
                    $media->profile_id = $id;
                    $media->save();
                    $profile->step_two_completed = true;
                }
            }
            $profile->save();
            return response()->json(['message' => 'Step two saved successfully']);
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

            if (Media::where('profile_id', $id)->count() == 0) {
                $profile->step_two_completed = false;
                $profile->save();
            }


            return response()->json(['message' => 'Media Deleted successfully']);
        }

        return abort(404);
    }

    public function ProfileAccsessStore(Request $request, $id)
    {
        $profile =  Profile::findOrFail($id);

        if ($profile->user_id == auth('sanctum')->id()) {
            $profile->private = $request->private;
            $profile->password = $request->password;
            $profile->save();
            return response()->json(['message' => 'saved successfully']);
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


    public function  ShowProfile($code)
    {
        $qrCode = QrCode::where('code', $code)->first();
        if (!$qrCode)  abort(404);

        $profile = Profile::where('qrcode_id', $qrCode->id)->where('step_one_completed', true)->where('step_two_completed', true)->with('media')->first();
        if (!$profile)  abort(404);

        if (!$profile->private) {
            return response()->json($profile, 200);
        }

        if (!auth('sanctum')->check()) {
            return abort(404);
        }

        if (auth('sanctum')->id() === $profile->user_id) {
            return response()->json($profile, 200);
        }

        abort(404);
    }
}
