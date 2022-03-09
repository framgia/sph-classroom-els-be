<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the specified User.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $url = Storage::url( 'avatar/' . $user->avatar);
        $response = [
            $user,
            'avatar' => 'http://localhost:82' . $url
        ];

        return $this->successResponse($response, 200); 
    }

    /**
     * Update the specified User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
       $user->fill($request->only([
            'name',
            'email'
        ]));

        if($user->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();

        return $this->showOne($user);
    }
}
