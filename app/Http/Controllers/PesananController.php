<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function pesanan(Request $request)
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

        switch ($request->method()) {
            case 'POST':
                return $this->createOrder($request);
            case 'GET':
                return $this->getOrders($request);
            default:
                return response()->json(['error' => 'Method not allowed'], 405);
        }
    }

    private function createOrder(Request $request)
    {
        $input = $request->only(['id_user', 'items', 'biaya', 'total_pembayaran', 'alamat']);

        if (!$request->has(['id_user', 'items', 'biaya', 'total_pembayaran', 'alamat'])) {
            return response()->json(['error' => 'All fields are required'], 400);
        }

        $id_user = $input['id_user'];
        $items = json_encode($input['items']);
        $biaya = $input['biaya'];
        $total_pembayaran = $input['total_pembayaran'];

        $user = DB::table('user')->where('user_id', $id_user)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $alamat = $user->alamat;
        $status = $request->input('status', 'pending');

        $orderId = DB::table('pesanan')->insertGetId([
            'id_user' => $id_user,
            'items' => $items,
            'biaya' => $biaya,
            'total_pembayaran' => $total_pembayaran,
            'alamat' => $alamat,
            'status' => $status
        ]);

        if ($orderId) {
            return response()->json(['message' => 'Order created successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to create order'], 500);
        }
    }

    private function getOrders(Request $request)
    {
        $id_user = $request->query('id_user');

        if (!$id_user) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $orders = DB::table('pesanan')->where('id_user', $id_user)->get();
        return response()->json($orders, 200);
    }
}
