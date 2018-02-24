<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Modules\Account\Events\UserHasLoggedIn;
use Modules\Account\Repositories\SocialAuthRepository;
use Modules\Servermessenger\Messenger\Task\TaskProducer;
use Modules\Users\Models\User;

class SocialAuthController extends Controller
{
    /**
     * @var SocialAuthRepository
     */
    private $socialAuthRepository;

    /**
     * SocialAuthController constructor.
     * @param SocialAuthRepository $socialAuthRepository
     */
    public function __construct(SocialAuthRepository $socialAuthRepository)
    {
        $this->socialAuthRepository = $socialAuthRepository;
    }

    public function facebookLogin()
    {
        // todo:: stores facebook auth user to our db
        /**
         * @var User $user
         */
        $user = $this->socialAuthRepository->initFacebookUser(\request());

        auth()->login($user);

        TaskProducer::publish(new UserHasLoggedIn($user));

        if(\request()->ajax()){
            return response()->json([
                'user' => auth()->user(),
                'message' => 'Successfully logged in',
                'redirect' => $user->requiresInitialSetup() ?
                    '/welcome/intro' :
                    redirect()->intended()->getTargetUrl()
            ]);
        }

        return 'logged in successfully';

    }

    // todo:: twitterLogin method
    public function twitterLogin(){
        return Socialite::driver('twitter')->redirect();
    }

    public function twitterDetail(){
        $twit_user = Socialite::driver('twitter')->user();

        /**
         * @var User $user
         */
        $user = $this->socialAuthRepository->initTwitterUser($twit_user);

        auth()->login($user);

        TaskProducer::publish(new UserHasLoggedIn($user));

        $redirect_path = !$user->requiresInitialSetup() ? redirect()->intended()->getTargetUrl() : '/welcome/intro?setup=account';

        return redirect($redirect_path);

    }
}
