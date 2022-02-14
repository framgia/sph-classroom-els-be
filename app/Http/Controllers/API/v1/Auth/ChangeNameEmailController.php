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
        $user = Auth::user();
   
        if (!Hash::check($request->password, $user->password)) {
            return $this->errorResponse(['password' => 'The password you have entered is incorrect.'], 401);
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        return $this->successResponse('successfully changed', 200);
    }
}
