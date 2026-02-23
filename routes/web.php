<?php

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): View {
    return view(view: 'welcome');
});

Route::get(uri: "/setup", action: function () {
    $credentials = [
        "email" => "admin@admin.com",
        "password" => "admin",
    ];

    if (!Auth::attempt(credentials: $credentials)) {
        $user = new User();

        $user->name = "Admin";
        $user->email = $credentials["email"];
        $user->password = Hash::make(value: $credentials['password']);

        $user->save();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $adminToken = $user->createToken("admin-token", ["create", "update", "delete"]);
            $updateToken = $user->createToken("update-token", ["create", "update"]);
            $basicToken = $user->createToken("basic-token");

            return [
                "admin" => $adminToken->plainTextToken,
                "update" => $updateToken->plainTextToken,
                "basic" => $basicToken->plainTextToken,
            ];
        }
    }
});
