<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        //$allowedOrigins = allowed_url_here;

        if (in_array($request->header('Origin'), $allowedOrigins)) {
            header('Access-Control-Allow-Origin', $request->header('Origin'));
            header('Access-Control-Allow-Methods', 'POST, OPTIONS');
            header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length');
            header('Access-Control-Allow-Credentials', 'true');
        }

        if ($request->isMethod('options')) {
            return response()->json([], 200);
        }

        if (!$request->isMethod('post')) {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        $input = $request->all();

        $user_id = $input['user_id'];

        if (!$user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        DB::table('user')
            ->where('user_id', $user_id)
            ->update([
                'nama' => $input['nama'],
                'email' => $input['email'],
                'no_telp' => $input['no_telp'],
            ]);

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
