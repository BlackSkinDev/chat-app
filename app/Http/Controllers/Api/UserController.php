<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Display user basic info
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show():JsonResponse
    {
        return $this->success(null,UserResource::make(auth()->user()),Response::HTTP_OK);
    }



    /**
     * Update user account info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * delete user account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
