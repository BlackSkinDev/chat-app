<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatMessageController extends Controller
{
    use ApiResponse;

    /**
     * get logged in user chats
     *
     * @return JsonResponse
     */
    public function index()//: JsonResponse
    {

    }
}
