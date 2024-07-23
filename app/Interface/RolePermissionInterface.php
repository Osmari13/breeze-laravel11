<?php

namespace App;

interface RolePermissionInterface
{
    public function store(array $data);
    public function update(array $data, $id);
    public function destroy($id);
}
