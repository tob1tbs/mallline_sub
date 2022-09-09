<?php

namespace App\Modules\Users\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Users\Models\User;
use App\Services\SocialFacebookAccountService;
use App\Services\SocialGoogleAccountService;

use Auth;
use Socialite;

class UsersController extends Controller
{

    public function __construct() {
        //
    }

    public function actionUsersIndex() {
        if(!Auth::check()) {
            return redirect()->route('actionUsersSignIn');
        } else {
            if (view()->exists('users.users_index')) {

                $data = [
                ];
                
                return view('users.users_index', $data);
            } else {
                abort('404');
            }
        }
    }

    public function actionUsersLogout() {
        Auth::logout();
        return redirect()->route('actionUsersSignIn');
    }

    public function actionUsersSignIn(Request $Request) {
        if(Auth::check()) {
            return redirect()->route('actionUsersIndex');
        } else {
            if (view()->exists('users.users_sign_in')) {

                $data = [
                ];
                
                return view('users.users_sign_in', $data);
            } else {
                abort('404');
            }
        }
    }

    public function actionUsersSignUp(Request $Request) {
        if(Auth::check()) {
            return redirect()->route('actionUsersIndex');
        } else {
            if (view()->exists('users.users_sign_up')) {

                $data = [
                ];
                
                return view('users.users_sign_up', $data);
            } else {
                abort('404');
            }
        }
    }

    public function actionUsersRestore(Request $Request) {
        if(Auth::check()) {
            return redirect()->route('actionUsersIndex');
        } else {
            if (view()->exists('users.users_password_reset')) {

                $data = [
                ];
                
                return view('users.users_password_reset', $data);
            } else {
                abort('404');
            }
        }
    }

    public function actionFacebookRedirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function actionGoogleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function actionFacebookCallback(SocialFacebookAccountService $service) {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->route('actionMainIndex');
    }

    public function actionGoogleCallback(SocialGoogleAccountService $service) {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        return redirect()->route('actionMainIndex');
    }
}
