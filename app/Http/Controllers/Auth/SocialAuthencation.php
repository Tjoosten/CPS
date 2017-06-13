<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class SocialAuthencation
 *
 * @package App\Http\Controllers\Auth
 */
class SocialAuthencation extends Controller
{
    /**
     * Redirect to the needed provider.
     *
     * @param  string $provider The social authencation provider.
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle the cllback for the needed provider.
     *
     * @param  string $provider The social authencation provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return Redirect::to("auth/{$provider}");
        }

        Auth::login($this->findOrCreateUser($user, $provider), true);

        return back();
    }

    /**
     * Find the user of create a new login with the needed provider.
     *
     * @param $user
     * @param $provider
     * @return mixed
     */
    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where("{$provider}_id", $user->id)->orWhere('email', $user->email)->first()) {
            return $authUser;
        }

        return User::create([
            'name'              => $user->name,
            'email'             => $user->email,
            "{$provider}_id"    => $user->id,
            'avatar'            => $user->avatar
        ]);
    }
}
