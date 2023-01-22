<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class SocialLoginRegisterController extends Controller
{
    //

    // google
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();

        $findUser = User::where('email', $user->email)->where('auth_type', 'google')->first();

        if ($findUser) {

            Auth::login($findUser);

            Toastr::success('Welcome to your profile :-)', 'Success');
            return redirect()->route('user.dashboard');

        } else {

            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => "2",
                'auth_type' => "google",
                'image' => $user->avatar_original,
                'provider_id' => $user->id,
                'created_at' => Carbon::now(),
            ]);

            Auth::login($newUser);

            Toastr::success('Welcome to your profile :-)', 'Success');

            return redirect()->route('user.dashboard');
        }
    }

    // facebook
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function facebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $findUser = User::where('email', $user->email)->where('auth_type', 'facebook')->first();

        if ($findUser) {

            Auth::login($findUser);

            Toastr::success('Welcome to your profile :-)', 'Success');
            return redirect()->route('user.dashboard');

        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => "2",
                'auth_type' => "facebook",
                'image' => $user->avatar,
                'provider_id' => $user->id,
                'created_at' => Carbon::now(),
            ]);

            Auth::login($newUser);

            Toastr::success('Welcome to your profile :-)', 'Success');
            return redirect()->route('user.dashboard');
        }
    }
}
