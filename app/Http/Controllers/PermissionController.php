<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interface\PermissionInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private PermissionInterface  $permissionInterface;
    public function __construct(PermissionInterface $permissionInterface)
    {
        $this->permissionInterface = $permissionInterface;
    }

    public function index()
    {
        $permission = $this->permissionInterface->index();
   
        return response()->json(['data' => $permission, 'message' => 'success'], 200);
    }
    public function store(Request $request)
    {
        $data = [
            "name" => $request->name,
            "guard_name" => "api"
        ];
        return Helper::transactional(function () use ($data, $request) {
            $permission = $this->permissionInterface->store($data);
            
            return Helper::jsonResponse(data: ['permission' => $permission]);
        });
    }
}
