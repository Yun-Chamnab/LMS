<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
     /**
     * Current User
     * @authenticated
     * @return JsonResponse
     */
    public function getUser()
    {
        
    }

    /**
     * Login
     *
     * @bodyParam email string required The email
     * @bodyParam password string required The password
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
       
    }

    /**
     * Register
     *
     * @bodyParam email string required The email
     * @bodyParam password string required The password
     * @bodyParam name string required The name
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        
    }

    /**
     * Verify User
     *
     * @queryParam token required The token
     *
     * @param String $token
     * @return JsonResponse
     * @throws Exception
     */
    public function verify($token)
    {
       
    }

    /**
     * Send new Password Request
     *
     * @bodyParam email string required The email
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request)
    {
       
    }

    /**
     * Create new P assword
     *
     * @bodyParam password string required The new password
     *
     * @param Request $request
     * @param $token
     * @return JsonResponse
     * @throws ValidationException
     */
    public function recoverPassword(Request $request, $token)
    {
       
    }
}
