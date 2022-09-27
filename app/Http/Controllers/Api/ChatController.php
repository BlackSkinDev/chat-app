<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatController extends Controller
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
                 'name'=>'Alex',
                 'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                 'last_msg' =>'Pick me at 9:00 Am'
             ],
            [
                'name'=>'Oluchi',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Banny',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Alfred',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Niyi',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Seyilaw',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Marv',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Okoso',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Otunba',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'In the middle',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
            [
                'name'=>'Oluwaranmileti',
                'image'=>'https://source.unsplash.com/_7LbC5J-jw4/600x600',
                'last_msg' =>'Pick me at 9:00 Am'
            ],
        ];

        return $this->success(null,$chats,Response::HTTP_OK);
    }


}
