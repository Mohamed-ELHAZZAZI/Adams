<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    public function login(Request $req)
    {
        if (Auth::guard('admin')->attempt(['Email' => $req->email, 'password' => $req->password])) {
            /** @var \App\Models\Admin $admin */
            $admin = Auth::guard('admin')->user();

            $token = $admin->createToken('AdminToken')->plainTextToken;
            return response()->json([
                'info' => $admin,
                'role' => $admin->role,
                'token' => $token,
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function getData(Request $req)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::user();

        if (!$admin) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'info' => $admin,
            'success' => true,
        ]);
    }

    public function logout(Request $req)
    {
        /** @var \App\Models\Admin $admin */
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response([
            'success' => true,
        ]);
    }
}
