<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'              =>$this->id,
            'sender_id'       =>$this?->sender_id,
            'receiver_id'     =>$this?->receiver_id,
            'text_message'    =>$this?->text_message,
            'picture_message' =>$this?->picture_message,
            'time'            =>Carbon::parse($this?->created_at)->format('H:i'),
            'isText'          =>(bool)($this->text_message)
        ];
    }
}
