<?php

namespace App\Interface;

interface RoleInterface
{
    public function index();
    public function store(array $data);
    public function update(array $data, $id);
    public function destroy($id);
}
