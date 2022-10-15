<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FriendsController extends Controller
{
    use ApiResponse;
    /**
     * get logged in user chats
     *
     * @return JsonResponse
     */
    public function index() :JsonResponse
    {
        $chats = [
             [
                 'id'=>1,
                 'name'=>'Alex',
                 'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                 'status'=>'Hey there, I am using Whatsapp',
                 'last_msg' =>null,
                 'last_msg_time'=>null
             ],
            [
                'id'=>2,
                'name'=>'Oluchi',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '14:56'
            ],
            [
                'id'=>3,
                'name'=>'Banny',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '15:56'
            ],
            [
                'id'=>4,
                'name'=>'Alfred',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '16:56'
            ],
            [
                'id'=>5,
                'name'=>'Niyi',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '17:56'
            ],
            [
                'id'=>6,
                'name'=>'Seyilaw',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '18:56'
            ],
            [
                'id'=>7,
                'name'=>'Marv',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'id'=>8,
                'name'=>'Okoso',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '19:56'
            ],
            [
                'id'=>9,
                'name'=>'Otunba',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '20:56'
            ],
            [
                'id'=>10,
                'name'=>'In the middle',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '21:56'
            ],
            [
                'id'=>11,
                'name'=>'Oluwaranmileti',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'status'=>'Hey there, I am using Whatsapp',
                'last_msg' =>'Pick me at 9:00 Am',
                'last_msg_time' => '22:56'
            ],
        ];

        // use resource

        return $this->success(null,$chats,Response::HTTP_OK);
    }


}
