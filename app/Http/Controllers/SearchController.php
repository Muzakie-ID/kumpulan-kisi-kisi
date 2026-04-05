<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        // Mulai dengan kondisi kosong jika belum ada pencarian
        $dokumens = collect();

        if ($query) {
            // Cari dari judul dokumen, deskripsi, atau dari relasi nama mapel
            $dokumens = Dokumen::with('mapel')
                ->where('judul', 'like', '%' . $query . '%')
                ->orWhere('deskripsi', 'like', '%' . $query . '%')
                ->orWhereHas('mapel', function($qMapel) use ($query) {
                    $qMapel->where('nama', 'like', '%' . $query . '%');
                })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Jika kosong, bisa tampilkan 5 dokumen terbaru saja sebagai saran
            $dokumens = Dokumen::with('mapel')->orderBy('created_at', 'desc')->take(5)->get();
        }

        return view('search.index', compact('dokumens', 'query'));
    }
}
