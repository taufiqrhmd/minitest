<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    public function tambahArtikel(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required',
            'isi_artikel' => 'required',
        ]);

        // Simpan artikel baru ke dalam database
        $artikel = new Artikel;
        $artikel->id_penulis = Auth::id(); // Mengambil id pengguna yang sedang terautentikasi
        $artikel->judul = $request->input('judul');
        $artikel->isi_artikel = $request->input('isi_artikel');
        $artikel->tanggal = now(); // Menggunakan fungsi now() untuk mendapatkan tanggal dan waktu saat ini
        $artikel->save();

        // Redirect atau lakukan tindakan lainnya (sesuai kebutuhan aplikasi)
        return redirect()->route('penulis.daftarArtikel');
    }

    public function updateArtikel(Request $request, $id)
    {
        // Validasi data inputan
        $validatedData = $request->validate([
            'judul' => 'required|max:50',
            'isi_artikel' => 'required',
        ]);

        // Cari artikel berdasarkan ID
        $artikel = Artikel::findOrFail($id);

        // Update data artikel
        $artikel->judul = $request->judul;
        $artikel->isi_artikel = $request->isi_artikel;
        $artikel->save();

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('penulis.daftarArtikel')->with('success', 'Artikel berhasil diupdate.');
    }

    public function landingPage()
    {
        $artikels = Artikel::all();

        return view('welcome', compact('artikels'));
    }

    public function showDetail($id)
    {
        $artikel = Artikel::findOrFail($id);
        $komentar = $artikel->komentar;

        return view('artikeldetail', compact('artikel', 'komentar'));
    }

    public function hapus($id)
    {
        $data = Artikel::find($id);
        $data->delete();

        return redirect()->back();
    }

    public function edit($id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);

        return view('penulis.update-artikel', compact('artikel'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'isi_komentar' => 'required',
            'email' => 'required|email',
            'id_artikel' => 'required',
        ]);

        $komentar = new Komentar();
        $komentar->nama = $validatedData['nama'];
        $komentar->isi_komentar = $validatedData['isi_komentar'];
        $komentar->email = $validatedData['email'];
        $komentar->save();

        // Membuat entri baru di tabel tb_detail
        $detail = new Detail();
        $detail->id_artikel = $validatedData['id_artikel'];
        $detail->id_komentar = $komentar->id_komentar;
        $detail->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
