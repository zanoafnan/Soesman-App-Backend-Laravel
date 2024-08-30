<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function updateLocation(Request $request)
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

        $input = $request->only(['user_id']);

        if (!$request->has('user_id')) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $user_id = $input['user_id'];

        $user = DB::table('user')->where('user_id', $user_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $alamat = $user->alamat;

        return response()->json(['alamat' => $alamat]);
    }
}
