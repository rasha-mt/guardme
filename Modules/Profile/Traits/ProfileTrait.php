<?php

namespace Modules\Profile\Traits;

use \Modules\Users\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
trait ProfileTrait
{
    
    private function updateProfile($request)
    {
        $user_id = auth()->user()->id;
        $errors = $this->validateProfile($request, $user_id);
        if (!$errors) {
            $data = $request->all();

            if ($user_id == $data['id']) {
                $userObj = User::find($user_id);
                $userObj->dob = $data['dob'];
                $userObj->phone_number = $data['phone_number'];
                $userObj->address = $data['address'];
                $userObj->username = $data['username'];
                $userObj->email = $data['email'];
                if (!empty($data['password'])) {
                    $userObj->password = bcrypt($data['password']);
                }
                $userObj->save();
            }
        }
        return $errors;
    }

    private function getProfile()
    {
        $profile = null;
        $user = auth()->user();
        if (!empty($user->profile_picture)) {
            $url = Storage::url('profile-pictures/'. $user->profile_picture);
            $user->profile_picture = $url;
        }
        return $user;
        
    }

    private function validateProfile($request, $id)
    {
        $rule = [
            'username' => 'required|max:25|unique:users,username,' .$id,
            'email' => 'required|email|max:90|unique:users,email,'.$id,
            'api_token' => 'required',
            'dob' => 'nullable|date',
            'phone_number' => 'nullable',
            'address' => 'nullable',
        ];
        
        $errors = Validator::make($request->all(), $rule)->errors()->messages();

        return $errors;
    }
    
}

