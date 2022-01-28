<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UploadImageRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UploadImageController extends Controller
{
    public function uploadImage(UploadImageRequest $request) 
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->avatar = $user->name . '-' . time() . '.' . $request->image->extension();
        $user->save();

        $image =  $user->name . '-' . time() . '.' . $request->image->extension();
        
        $request->image->move(public_path('avatar'), $image);
    
        return $this->successResponse('successfully uploaded', 200);
    }
}
