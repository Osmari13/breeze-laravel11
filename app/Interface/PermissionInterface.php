<?php

namespace App\Interface;

interface PermissionInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data, $id);
    public function destroy($id);
}
