<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * login user
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request):JsonResponse
    {

        if (!Auth::attempt($request->validated())) {
            return $this->error("Invalid login credentials", null,Response::HTTP_UNAUTHORIZED);
        }

        return $this->success(
            'Login success',
             ['token'=>auth()->user()->createToken('API Token')->plainTextToken],
            Response::HTTP_OK
        );
    }

    /**
     * logout user
     * @return JsonResponse
     */
    public function logout():JsonResponse
    {
        auth()->user()->tokens()->delete();
        return $this->success('Logged out',null,Response::HTTP_OK);
    }


}
