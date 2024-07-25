<?php

namespace App\Repository;

use App\Interface\PermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        return Permission::all();  
    }
    public function store(array $data)
    {
        return Permission::create($data);
    }

    public function update(array $data, $id)
    {
        return Permission::where('id', $id)->update($data);
    }
    public function destroy($id)
    {
        return Permission::destroy($id);
    }
}
