<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
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
     * @return JsonResponse
     */
    public function show():JsonResponse
    {
        $user = request('user') ? User::where('id',request('user'))->firstorfail() : auth()->user();
        return $this->success(null,UserResource::make($user),Response::HTTP_OK);
    }



    /**
     * Update user account info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * delete user account.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
