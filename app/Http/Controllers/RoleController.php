<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interface\RoleInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private RoleInterface  $roleInterface;
    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }

    public function index()
    {
        $role = $this->roleInterface->index();
        return response()->json(['data' => $role, 'message' => 'success'], 200);
    }
    public function store(Request $request)
    {
        $data = [
            "name" => $request->name,
            "guard_name" => "web"
        ];
        return Helper::transactional(function () use ($data, $request) {
            $permissionsID = array_map(
                function($value) { return (int)$value; },
                $request->input('permission',[])
            );
           
            $role = Role::create(['name' => $request->input('name'), "guard_name" => "web"]);
            $role->syncPermissions($permissionsID);
          
      
            return Helper::jsonResponse(data: ['role' => $role]);
        });
    }

    public function destroy($id)
    {
        return Helper::transactional(function () use ($id) {
            $this->roleInterface->destroy($id);
            return response()->json(['message' => 'success'], 200);
                        
        });
        
        
    }
}
