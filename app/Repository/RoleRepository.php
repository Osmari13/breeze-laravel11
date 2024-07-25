<?php

namespace App\Repository;

use App\Interface\RoleInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        return Role::all();  
    }
    public function store(array $data)
    {
        return Role::create($data);
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
