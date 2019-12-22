<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * LogoutController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Logs out user / invalidates access token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        auth("api")->logout();

        return response()->json(['message' => 'Successfully logged out!']);
    }
}
