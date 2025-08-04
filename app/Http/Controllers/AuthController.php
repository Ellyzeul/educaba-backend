<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @response array{token: "1|4QmFM3818wBJ9dhT5G52zEICnMkKCAq4GQf7fJYW6d80ba3k", expires_at: "2024-11-22T03:18:25.000000Z"}
     */
    public function auth(Request $request)
    {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response(['message' => __('messages.auth.failed')], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        if(!isset($user)) return response([], 500);

        $token = $this->issueToken($user);

        return [
            'token' => $token->plainTextToken,
            'expires_at' => $token->accessToken['expires_at'],
        ];
    }

    private function issueToken(User $user)
    {
        return $user->createToken('user-token', [], now()->addDay());
    }
}
