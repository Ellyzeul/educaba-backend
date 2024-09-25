<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Contracts\User as GoogleUser;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    private Provider $driver;

    public function __construct()
    {
        $this->driver = Socialite::driver('google');
    }

    public function redirect()
    {
        return $this->driver->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = $this->retrieveGoogleUser();
            $user = User::where('email', $googleUser->getEmail())->first();

            if(!isset($user)) {
                $user = $this->insertGoogleUser($googleUser);
            }

            Auth::login($user);

            return redirect()->intended('/');
        } catch(Throwable $err) {
            Log::error("Error on Google authentication: " . $err->getMessage());

            return response(['message' => 'Internal error...'], 500);
        }
    }

    private function retrieveGoogleUser()
    {
        if(app()->environment('local')) {
            return $this->driver->setHttpClient(new Client(['verify' => false]))->user();
        }
        
        return $this->driver->user();
    }

    private function insertGoogleUser(GoogleUser $googleUser)
    {
        $user = new User([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
        ]);

        $user->save();

        return $user;
    }
}
