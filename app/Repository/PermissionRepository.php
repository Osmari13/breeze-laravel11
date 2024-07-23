<?php

namespace App\Repository;
use App\RolePermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements RolePermissionInterface
{
    /**
     * Create a new class instance.
     */
    public function store(array $data)
    {
        return Permission::created($data);
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
