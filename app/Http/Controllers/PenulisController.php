<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        // Cari artikel berdasarkan ID
        $artikel = Penulis::findOrFail($id);

        // Update data artikel
        $artikel->status = $request->status;
        $artikel->save();

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->back();
    }
}
