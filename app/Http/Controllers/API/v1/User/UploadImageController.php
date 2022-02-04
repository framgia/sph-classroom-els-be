<?php

namespace App\Http\Controllers\API\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UploadImageRequest;  
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{
    public function uploadAvatar(UploadImageRequest $request) 
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->avatar = $user->id . '-' . time() . '.' . $request->image->extension();
        $user->save();

        $image =  $user->id . '-' . time() . '.' . $request->image->extension();
        
        $request->image->move(storage_path('app/public/avatar'), $image);
    
        return $this->successResponse('successfully uploaded', 200);
    }
}
