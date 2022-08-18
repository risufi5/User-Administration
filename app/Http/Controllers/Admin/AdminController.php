<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminDeleteRequest;
use App\Http\Requests\Admin\AdminEditRequest;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function create(AdminRegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'password' => Hash::make($data['password']),
        ]);
        $user->syncRoles($data['role']??'user');

        return response()->json(['message'=>'User successfully registered!']);
    }

    public function edit(AdminEditRequest $request){
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $user->syncRoles($data['role']);

        return response()->json(['message'=>'User successfully updated!']);
    }

    public function delete(AdminDeleteRequest $request){
        $data = $request->validated();
        $user = User::find($data['id']);
        $user->delete();

        return response()->json(['message'=>'User successfully deleted!']);
    }
}
