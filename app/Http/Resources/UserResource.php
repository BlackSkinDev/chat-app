<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $last_message = $this->getLastMessageWithAuthUser($this->id) ?? null;

        return [
            'id'                     =>$this->id,
            'username'               =>$this->username,
            'email'                  =>$this->email,
            'avatar'                 =>$this->avatar ?? config('app.url')."/images/avatar.png",
            'last_text_message'      =>$last_message?->text_message ,
            'last_picture_message'   =>$last_message?->picture_message ,
            'last_message_time'      =>$last_message ? Carbon::parse($last_message->created_at)->format('H:i')  : null,//->created_at)->format('H:i'),
        ];
    }
}
