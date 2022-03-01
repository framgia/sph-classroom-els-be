<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvitationToJoinAsAdmin;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\SetPasswordRequest;

class AdminController extends Controller
{
    public function store(StoreAdminRequest $request)
    {
        define('ADMIN_TYPE_ID', 1);

        $admin = User::create([
            'user_type_id' => ADMIN_TYPE_ID,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ]);

        $admin->notify(new InvitationToJoinAsAdmin($admin));

        $response = [
            'admin' => $admin,
            'message' => trans('auth.admin-created')
        ];

        return $this->authResponse($response, 201);
    }
}
