<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananKurirController extends Controller
{
    public function pesanankurir(Request $request)
    {
        //$allowedOrigins = allowed_url_here;

        if (in_array($request->header('Origin'), $allowedOrigins)) {
            header('Access-Control-Allow-Origin', $request->header('Origin'));
            header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Content-Length');
            header('Access-Control-Allow-Credentials', 'true');
        }

        if ($request->isMethod('options')) {
            return response()->json([], 200);
        }

        if ($request->isMethod('get')) {
            return $this->getOrders();
        } elseif ($request->isMethod('post')) {
            return $this->updateOrderStatus($request);
        }

        return response()->json(['error' => 'Method not allowed'], 405);
    }

    private function getOrders()
    {
        $orders = DB::table('pesanan')->get();
        return response()->json($orders, 200);
    }

    private function updateOrderStatus(Request $request)
    {
        $id_order = $request->input('id_order');
        $status = $request->input('status');

        if (!$id_order || !$status) {
            return response()->json(['error' => 'Order ID and status are required'], 400);
        }

        $affected = DB::table('pesanan')
            ->where('id_order', $id_order)
            ->update(['status' => $status]);

        if ($affected) {
            return response()->json(['message' => 'Order status updated successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to update order status'], 500);
        }
    }
}
