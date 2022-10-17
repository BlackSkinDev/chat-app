<?php

namespace App\Http\Controllers\Api;

use App\Events\NewPrivateMessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatMessageResource;
use App\Models\Message;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
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
    public function index() : JsonResponse
    {
        $user_id = request('user') ?? null;

        if ($user_id){
            $user = User::where('id',$user_id)->firstorfail();

            $messages = Message::where('sender_id',$user->id)
                ->where('receiver_id',auth()->id())
                ->orWhere('sender_id',auth()->id())
                ->where('receiver_id',$user_id)
                ->orderBy('created_at','asc')
                ->get() ->groupBy(function($message){
                    return Carbon::parse($message->created_at)->format('F d, Y');
                });;

            return $this->success(null,$this->format($messages),Response::HTTP_OK);
        }

        return $this->error('Please specify user',null,Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * send message and broadcast to others
     *
     * @return JsonResponse
     */
    public function store() : JsonResponse
    {
        $message = auth()->user()->messages()->create(['message'=>request('message')]);
        broadcast(new NewPrivateMessageSent(auth()->user(),$message->load('user')))->toOthers();
        return $this->success('Sent',null,Response::HTTP_OK);
    }

    /**
     * format the message
     *
     * @return JsonResponse
     */
    public function format($messages) : Object
    {
        foreach ($messages as $date => $dateMessages){
            $messages[$date] = ChatMessageResource::collection($dateMessages);
        }
        return $messages;
    }
}
