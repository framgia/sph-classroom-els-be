<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePassword\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->successResponse('Your password has been successfully changed', 200);
        } else {
            return $this->errorResponse('Incorrect Password.', 422);
        }
    }   
}
