<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    use ApiResponse;

    /**
     * get logged in user chats
     *
     * @return JsonResponse
     */
    public function index() :JsonResponse
    {
        $has_conversation = request('has_conversation') === 'true' ?? null;
        $search_username = request('username') ?? null;

        $users = User::where('id', '!=', auth()->id())
            ->when($search_username, function ($q) use ($search_username) {
                return $q->where('username', 'like', '%' . $search_username . '%');
            })->get();


        // Add property 'has_conversation' to users object to identify those who have conversation with logged_in user
        collect($users)->map(function ($user) {
            $last_message = $user->getLastMessageWithAuthUser($user->id) ?? null;
            $user->has_conversation = (bool)$last_message;
            $user->last_message_time = $last_message ? Carbon::parse($last_message->created_at)->format('Y-m-d H:i:s') : null;
            return $user;
        });


        // Filter out users to get only users with conversations with logged_in user
        if ($has_conversation) {
            $users = $users->filter(function ($user) {
                return $user->has_conversation === true;
            });
        }

        // Order users being returned by conversation had with logged_in user, Users without conversation come last
        $users = $users->values();
        $users = $users->sortByDesc('last_message_time');
        $users->all();

        return $this->success(null, UserResource::collection($users), Response::HTTP_OK);
    }


}
