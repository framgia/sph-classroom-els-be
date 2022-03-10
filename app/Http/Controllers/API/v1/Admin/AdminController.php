<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\Pagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\InvitationToJoinAsAdmin;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\SetAdminPasswordRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;

class AdminController extends Controller
{
    use Pagination;

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

    public function setNewPassword(SetAdminPasswordRequest $request)
    {
        $admin = User::where([['email', $request->email], ['user_type_id', 1]])->first();

        if(!$admin) {
            return $this->errorResponse(['error' => 'There is no admin account associated with this email.'], 422);
        }

        $admin->password = bcrypt($request->password);
        $admin->save();

        return $this->successResponse(['message' => 'Your new password has been successfully saved.'], 200);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $admin = Auth::user();

        if(!Hash::check($request->password, $admin->password)){
            return $this->errorResponse(['password' =>  trans('auth.password')], 401); 
        }

        $admin->password = bcrypt($request->new_password);
        $admin->save();

        return $this->successResponse(['message' => 'Your password has been successfully updated.'], 200);
    }

    public function getAdminAccounts()
    {
        $id = Auth::user()->id;

        $query = request()->query();

        $admins = User::searchOtherAdminAccounts($id, $query['search'])
                        ->where('id', '!=', $id)
                        ->where('user_type_id', 1);

        if(isset($query['sortDirection'])){
            return $admins->orderBy($query['sortBy'], strtolower($query['sortDirection']))->paginate(12);
        }

        return $this->paginate($admins->get());
    }
}
