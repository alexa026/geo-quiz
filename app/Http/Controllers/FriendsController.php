<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class FriendsController extends Controller
{
    /**
     * Return friends of user.
     * 
     * @param $id
     * @return mixed
     */
    public function ofUser($id)
    {
        $user = User::findOrFail($id);
        
        return $user->friends();
    }

    /**
     * Add a friendship route.
     *
     * @param Request $request
     */
    public function addFriendship(Request $request)
    {
        $data = $request->only('user1_id', 'user2_id');
        $user1_id = $data['user1_id'];
        $user2_id = $data['user2_id'];

        $user1 = User::findOrFail($user1_id);
        $user2 = User::findOrFail($user2_id);

        $user1->friends()->attach($user2->id);
        $user2->friends()->attach($user1->id);
    }
}
