<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    use ApiResponse;
    /**
     * register new user
     * @param null
     * @return object
     */
    public function store(RegisterRequest $request)
    {
        User::create($request->validated());
        return  $this->success(null,'Registration successful',Response::HTTP_CREATED);
    }
}
