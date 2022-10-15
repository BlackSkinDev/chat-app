<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $text_messages = [
            "Hey bro I'm around",
            "I am back fam",
            "We are going tomorrow",
            null,
            null,
            null,
            null,
            "Are you watching manutd tomorrow?",
            "Call Mike now",
            "Yo fam, those guys are cowards",
            "Good morning baby",
            "I got the Job fam",
            "Big up to you bro",
            null,
            null,
            null,
            null,
            null
        ];
        $picture_messages = ['https://source.unsplash.com/random/800x800'];
        return [
            'sender_id'       =>$user = User::inRandomOrder()->first(),
            'receiver_id'     =>User::inRandomOrder()->where('id','!=',$user->id)->first(),
            'text_message'    =>$msg = Arr::random($text_messages),
            'picture_message' => !$msg ? $picture_messages[0] : null
        ];
    }
}
