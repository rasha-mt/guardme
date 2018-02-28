<?php

namespace Modules\Profile\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Users\Models\User;
use Modules\Profile\Traits\ProfileTrait;

class ProfileController extends Controller
{
    use ProfileTrait;
    public function index()
    {
        return $this->getUserProfilePage();
    }
    public function verification() {
        return view('profile::profile.verification');
    }
    private function getUserProfilePage()
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        if($user){
            // $role = $user->getPrimaryRole();

            $view = 'profile::profile.full-profile';

            return view($view);
        }

        return ;
    }

    public function store() {

    }
}
