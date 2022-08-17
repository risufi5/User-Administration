<?php
namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminEditRequest;
use App\Http\Requests\auth\AuthenticatedChangePasswordRequest;
use App\Http\Requests\auth\AuthenticatedEditRequest;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Contracts\DataTable;

class UserController extends Controller
{
    /**
     * Show list of admin datatable
     */

    public function showUsersDatatable(Request $request)
    {
        if ($request->ajax()){
            $data = User::with('roles')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row){
                    $btn='<button type="button" class="btn btn-primary btn-sm editUser" data-toggle="modal"
                    data-target="#editUserModal">Edit</button> ';
                    $btn.='<button class="btn btn-danger btn-sm deleteUser" data-toggle="modal"
                    data-target="#deleteUserModal">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.index');
    }

    public function getRoles(){
        return Role::select('name')->get();
    }

    public function changePassword(AuthenticatedChangePasswordRequest $request){
        if (!(Hash::check($request->get('currentPassword'), Auth::user()->password))) {
            // The passwords matches
            return response()->json(['message'=>'Your current password does not matches with the password.'], 500);
        }

        if(strcmp($request->get('currentPassword'), $request->get('newPassword')) == 0){
            // Current password and new password same
            return response()->json(['message'=>'New Password cannot be same as your current password.'], 500);
        }

        $data = $request->validated();
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($data['newPassword']),
        ]);

        return response()->json(['message'=>'Password successfully changed!']);
    }

    public function editProfile(AuthenticatedEditRequest $request){

            $data = $request->validated();
            $user = Auth::user();
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            return response()->json(['message'=>'Account successfully updated!']);

    }

    public function deleteProfile(){
        Auth::user()->delete();
        Auth::logout();
    }
}
