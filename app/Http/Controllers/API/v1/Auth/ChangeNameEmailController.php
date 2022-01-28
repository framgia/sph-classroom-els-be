<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangeNameEmailRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangeNameEmailController extends Controller
{
    public function changeName(ChangeNameEmailRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        if (!$user || !Hash::check($request->password, $user->password)) {
            if(!$user){
                return $this->errorResponse(['error' => 'The email you have entered is incorrect.'], 401);
            } else {
                return $this->errorResponse(['error' => 'The password you have entered is incorrect.'], 401);
            }
        }

        return $this->successResponse('successfully changed', 200);
    }
}
