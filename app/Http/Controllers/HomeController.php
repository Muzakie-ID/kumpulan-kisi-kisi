<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil semua dokumen + data mapel-nya, diurutkan dari yang terbaru
        $dokumens = \App\Models\Dokumen::with('mapel')->orderBy('created_at', 'desc')->get();
        return view('home.index', compact('dokumens'));
    }
}
