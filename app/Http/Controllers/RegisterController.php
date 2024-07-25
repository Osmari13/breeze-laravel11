<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Helpers\Helper;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
   
    public function index()
    {
        
        //OPCION UNO DE EXTRAER DATOS

        $users= User::with('roles:id,name')
                    ->get()
                    ->makeHidden(['created_at', 'updated_at', 'email_verified_at']);
       
        $users->flatMap(function ($user) {
            return $user->getPermissionsViaRoles()->map(function ($permission) {                
                return $permission->makeHidden(['guard_name', 'created_at', 'updated_at', 'pivot']);
            })->pluck('name');
        })->toArray();
        
        //OPCION DOS DE EXTRAER DATOS

        // $users = User::with('roles', 'permissions')
        //      ->get()
        //      ->makeHidden(['created_at', 'updated_at', 'email_verified_at']);

        // $usersData = $users->map(function ($user) {
        //     return [
        //         'id' => $user->id, 
        //         'name' => $user->name, 
        //         'roles' => $user->roles->pluck('name'),
        //         'permissions' => $user->getPermissionsViaRoles()->pluck('name'),
        //     ];
        // });
       
        return response()->json(['users'=> $users], 200);
    }
    public function store(Request $request)
    {
        return Helper::transactional(function () use ($request) {
           
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
      
            $user->assignRole($request->input('role'));
            return Helper::jsonResponse(data: ['user' => RegisterResource::make($user)]);
        });
    }
}
