<?php

namespace App\Http\Controllers\Api;

use App\Events\NewPrivateMessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
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
        return $this->success(null,Message::all(),Response::HTTP_OK);
    }

    /**
     * send message
     *
     * @return JsonResponse
     */
    public function store()//: JsonResponse
    {

        auth()->user()->messages()->create(['message'=>request('message')]);
        //broadcast(new NewPrivateMessageSent(auth()->user(),request('message')))->toOthers();
        return $this->success('Sent',null,Response::HTTP_OK);
    }
}
