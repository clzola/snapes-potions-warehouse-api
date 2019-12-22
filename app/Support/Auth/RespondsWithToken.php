<?php

namespace App\Support\Auth;

trait RespondsWithToken
{
    /**
     * Returns access token response.
     *
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',

            // getTTL() returns in minutes (JWT_TTL),
            // so we multiply with 60 to get seconds
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}