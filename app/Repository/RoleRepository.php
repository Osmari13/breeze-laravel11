<?php

namespace App\Repository;


use App\RoleInterface;
use App\RolePermissionInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RolePermissionInterface
{
    /**
     * Create a new class instance.
     */
    public function store(array $data)
    {
        return Role::created($data);
    }

    public function update(array $data, $id)
    {
        return Role::where('id', $id)->update($data);
    }
    public function destroy($id)
    {
        return Role::destroy($id);
    }
}
