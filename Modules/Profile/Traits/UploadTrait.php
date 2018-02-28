<?php

namespace Modules\Profile\Traits;

use \Modules\Users\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
trait UploadTrait
{

    private function saveUploadedProfilePicture($request) {
        $errors = $this->validateProfilePicture($request);
        if (!$errors) {
            $user_id = auth()->user()->id;
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $path = Storage::putFileAs('public/profile-pictures', $request->file('profile_picture'), 'profile_picture_'.$user_id.'.'.$extension);
            if (!empty($path)) {
                $path = explode('/', $path);
                $path = $path[count($path)-1];
                $userObj = User::find($user_id);
                $userObj->profile_picture = $path;
                $userObj->save();
            }
        }
        return $errors;
    }

    private function validateProfilePicture($request)
    {
        $rule = [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $errors = Validator::make($request->all(), $rule)->errors()->messages();

        return $errors;
    }

}

