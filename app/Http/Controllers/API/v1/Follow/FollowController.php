<?php

namespace App\Http\Controllers\API\v1\Follow;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Follow a specific student user.
     *
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $id = Auth::user()->id;

        $logged_in_user = User::find($id);
        $to_follow_user = User::find($request->user_id);

        if($logged_in_user->isFollowing($to_follow_user)){
            return $this->errorResponse('You are already following this user', 422);
        };

        $logged_in_user->follow($to_follow_user);

        return $this->successResponse("Successfully followed student", 200);
    }

    public function unfollow(Request $request)
    {
        $id = Auth::user()->id;

        $logged_in_user = User::find($id);
        $to_unfollow_user = User::find($request->user_id);

        if(!$logged_in_user->isFollowing($to_unfollow_user)){
            return $this->errorResponse('You are not following this user', 422);
        };

        $logged_in_user->unfollow($to_unfollow_user);

        return $this->successResponse("Successfully unfollowed student", 200);
    }
}