<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\GetAccessTokenRequest;
use App\Support\Auth\RespondsWithToken;

class RequestAccessTokenController extends Controller
{
    use RespondsWithToken;

    /**
     * Creates new access token.
     *
     * @param GetAccessTokenRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(GetAccessTokenRequest $request)
    {
        $credentials = $request->all(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
