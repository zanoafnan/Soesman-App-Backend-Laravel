<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
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

        $input = $request->json()->all();

        if (!isset($input['email']) || !isset($input['password'])) {
            return response()->json(['error' => 'Email and password are required'], 400);
        }

        $email = $input['email'];
        $password = $input['password'];

        $user = DB::table('user')->where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                Session::put('name', $user->nama);
                Session::put('user_id', $user->user_id);

                return response()->json([
                    'message' => 'Login successful',
                    'user_id' => $user->user_id,
                    'nama' => $user->nama,
                    'email' => $user->email,
                    'no_telp' => $user->no_telp,
                ], 200);
            } else {
                return response()->json(['error' => 'Informasi Login Salah'], 401);
            }
        } else {
            return response()->json(['error' => 'Mohon maaf silakan coba lagi'], 404);
        }
    }
}
