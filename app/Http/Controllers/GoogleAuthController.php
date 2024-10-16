<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Contracts\Provider;
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
                return response(['message' => 'User does not exist...'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            Auth::login($user);

            return redirect()->intended('/');
        } catch(Throwable $err) {
            Log::error("Error on Google authentication: " . $err->getMessage());

            return response(['message' => 'Internal error...'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function retrieveGoogleUser()
    {
        if(app()->environment('local')) {
            return $this->driver->setHttpClient(new Client(['verify' => false]))->user();
        }
        
        return $this->driver->user();
    }
}
