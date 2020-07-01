<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials for uer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Wrong email or password.'], 401);
        }

        return $this->respondWithTokenUser($token);
    }

    /**
     * Get a JWT via given credentials for admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAdmin()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Wrong email or password.'], 401);
        }

        return $this->respondWithTokenAdmin($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function meUser()
    {
        return response()->json(auth()->user());
    }

        /**
     * Get the authenticated Admin.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function meAdmin()
    {
        return response()->json(auth('admin')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Log the admin out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutAdmin()
    {
        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh user token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshUser()
    {
        return $this->respondWithTokenUser(auth()->refresh());
    }

    /**
     * Refresh admin token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshAdmin()
    {
        return $this->respondWithTokenAdmin(auth('admin')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenUser($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'email' => auth()->user()->email,
            'username' => auth()->user()->username,
        ]);
    }

        /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenAdmin($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'email' => auth()->user()->email,
            'username' => auth()->user()->name . ' ' . auth()->user()->last_name,
        ]);
    }
}
