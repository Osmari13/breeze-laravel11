<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use function App\Helpers\jsonResponse;
use function App\Helpers\transactional;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        return transactional(function () use ($request) {
            $user = User::create($request->all());
            $user->assignRole(Roles::USER->value);

            return jsonResponse(data: ['user' => RegisterResource::make($user)]);
        });
    }
}
