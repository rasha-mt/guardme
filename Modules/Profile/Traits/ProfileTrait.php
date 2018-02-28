<?php

namespace Modules\Profile\Traits;

use \Modules\Users\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
        $user = null;
        $user_id = auth()->user()->id;
        if ($user_id) {
            // get user data
            $user =  DB::table('users')
                ->select(
                    'users.id',
                    'users.username',
                    'users.email',
                    'users.api_token',
                    'users.dob',
                    'users.address',
                    'users.phone_number',
                    'users.profile_picture',
                    'roles.name as role_name'
                )
                ->where('users.id', $user_id)
                ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                ->join('roles', 'roles.id', '=', 'user_roles.role_id')
                ->first();
            if (!empty($user->profile_picture)) {
                $url = Storage::url('profile-pictures/'. $user->profile_picture);
                $user->profile_picture = $url;
            }
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

