<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AvatarUploadRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Response;

class AvatarController extends Controller
{
    use ApiResponse;

    /**
     * register new user
     * @param AvatarUploadRequest $request
     * @return JsonResponse
     */
    public function store(AvatarUploadRequest $request):JsonResponse
    {
        $uploadedFileUrl = Cloudinary::upload($request->file('file')->getRealPath())->getSecurePath();
        auth()->user()->update(['avatar'=>$uploadedFileUrl]);
        return  $this->success('Avatar uploaded successful',$uploadedFileUrl,Response::HTTP_CREATED);
    }
}
