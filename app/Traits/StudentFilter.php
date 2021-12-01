<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\DB;

trait StudentFilter
{
    protected function filter($query, $id)
    {
        if($query['filter'] === "followed"){
            $followed_students = User::join('user_follower', 'users.id', '=', 'user_follower.following_id')
                                     ->where('user_follower.follower_id', '=', $id)
                                     ->searchAndExcludeAdmins($query['search']);
                             
            return $followed_students;
        }else if($query['filter'] === "followers"){
            $followers = User::join('user_follower', 'users.id', '=', 'user_follower.follower_id')
                             ->where('user_follower.following_id', '=', $id)
                             ->searchAndExcludeAdmins($query['search']);
              
            return $followers;
        }else{
            $followed_students_id = DB::table('user_follower')
                                      ->where('follower_id', '=', $id)
                                      ->get()
                                      ->pluck('following_id')
                                      ->all();

            $unfollowed_students = User::whereNotIn('id', $followed_students_id)
                                       ->searchAndExcludeLoggedInUserAndAdmins($id, $query['search']);
                          
            return $unfollowed_students;
        }
    }
}