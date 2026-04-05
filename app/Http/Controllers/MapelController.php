<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index()
    {
        // Menampilkan daftar mapel dengan jumlah dokumen di dalamnya
        $mapels = Mapel::withCount('dokumens')->get();
        return view('mapel.index', compact('mapels'));
    }

    public function show($slug)
    {
        // Menampilkan dokumen yang spesifik pada satu mapel berdasarkan slug
        $mapel = Mapel::where('slug', $slug)->firstOrFail();
        
        $dokumens = $mapel->dokumens()->orderBy('created_at', 'desc')->get();

        return view('mapel.show', compact('mapel', 'dokumens'));
    }
}
