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

        $user->avatar =  $request->image->getClientOriginalName();
        $user->save();

        $image =  $request->image->getClientOriginalName();
        
        $request->image->move(public_path('avatar'), $image);
    
        return $this->successResponse('successfully uploaded', 200);
    }
}
