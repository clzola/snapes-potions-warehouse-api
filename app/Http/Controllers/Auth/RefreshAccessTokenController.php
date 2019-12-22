<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\Auth\RespondsWithToken;

class RefreshAccessTokenController extends Controller
{
    use RespondsWithToken;

    /**
     * LogoutController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Refreshes user's access token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }
}
