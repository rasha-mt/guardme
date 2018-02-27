<?php

namespace Modules\Profile\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Users\Models\User;
use Modules\Profile\Traits\ProfileTrait;
use Modules\Profile\Traits\UploadTrait;

class ProfileController extends Controller
{
    use ProfileTrait, UploadTrait;

    public function getUserProfile() {
        return $this->getProfile();
    }

    public function save(Request $request) {
        $errors = $this->updateProfile($request);
        return response()->json([
            'status' => $errors ? 500 : 200,
            'errors' => $errors,
        ]);
    }
    public function uploadProfilePicture(Request $request) {
        $errors = $this->saveUploadedProfilePicture($request);
        return response()->json([
           'status' => $errors ? 500 : 200,
            'errors' => $errors
        ]);
    }
}
