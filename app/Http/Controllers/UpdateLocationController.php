<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateLocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        // Validasi request
        $this->validate($request, [
            'user_id' => 'required',
            'alamat' => 'required|string',
        ]);

        $alamat = $request->input('alamat');

        $user_id = $request->input('user_id');
        DB::table('user')->where('user_id', $user_id)->update(['alamat' => $alamat]);

        return response()->json(['success' => true, 'message' => 'Alamat berhasil diperbarui'], 200);
    }
}
