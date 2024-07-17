<?php

namespace App\Http\Controllers;

use App\Enums\AuthProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthProviderController extends Controller
{
    public function redirectToProvider(AuthProvider $provider)
    {
        return Socialite::driver($provider->value)->redirect();
    }

    public function handleProviderCallback(AuthProvider $provider)
    {
        $authProviderUser = Socialite::driver($provider->value)->user();

        $user = User::updateOrCreate([
            'auth_provider_type' => $provider->value,
            'auth_provider_id' => $authProviderUser->id,
        ], [
            'name' => $authProviderUser->name,
            'email' => $authProviderUser->email,
            'auth_provider_type' => $provider->value,
            'auth_provider_id' => $authProviderUser->id,
            'auth_provider_token' => $authProviderUser->token,
            'auth_provider_refresh_token' => $authProviderUser->refreshToken,
        ]);

        Auth::login($user);

        return to_route('dashboard');
    }
}
