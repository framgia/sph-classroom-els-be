<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\DB;

trait StudentFilter
{
    protected function filter($query, $id)
    {
        if($query['filter'] === "followed"){
            $followed_students = User::withCount(['followings', 'followers'])
                                ->join('user_follower', 'users.id', '=', 'user_follower.following_id')
                                ->where('user_follower.follower_id', '=', $id)
                                ->get();

            return $followed_students;
        }else if($query['filter'] === "followers"){
            $followers = User::withCount(['followings', 'followers'])
                        ->join('user_follower', 'users.id', '=', 'user_follower.follower_id')
                        ->where('user_follower.following_id', '=', $id)
                        ->get();

            return $followers;
        }else{
            $followed_students_id = DB::table('user_follower')
                                    ->where('follower_id', '=', $id)
                                    ->get()
                                    ->pluck('following_id')
                                    ->all();

            $unfollowed_students = User::withCount(['followings', 'followers'])
                                ->whereNotIn('id', $followed_students_id)
                                ->where('users.id', '!=', $id)
                                ->get();

            return $unfollowed_students;
        }
    }
}