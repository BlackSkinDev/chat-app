<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    use ApiResponse;

    /**
     * register new user
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function store(RegisterRequest $request):JsonResponse
    {
        User::create($request->validated());
        return  $this->success('Registration successful',null,Response::HTTP_CREATED);
    }
}
