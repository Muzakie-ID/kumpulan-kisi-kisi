<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Dokumen;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $mapels = Mapel::all();
        $dokumens = Dokumen::with('mapel')->orderBy('created_at', 'desc')->get();
        return view('admin.index', compact('mapels', 'dokumens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mapels,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|max:5120', // Maksimal 5MB, format umum
        ]);

        $file = $request->file('file');
        
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        
        // Simpan file ke public disk
        $path = $file->storeAs('dokumen_kelas', $fileName, 'public');

        Dokumen::create([
            'mapel_id' => $request->mapel_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tipe_file' => strtolower($extension),
            'path_file' => $path,
            'ukuran_file' => round($file->getSize() / 1024), // Menyimpan dalam kilobyte (KB)
        ]);

        return redirect()->route('home.index')->with('success', 'Dokumen berhasil diupload!');
    }

    public function storeMapel(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:mapels,nama',
            'icon' => 'nullable|string|max:50'
        ]);

        Mapel::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'icon' => $request->icon ?? 'fa-book'
        ]);

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }

    public function destroyMapel($id)
    {
        $mapel = Mapel::findOrFail($id);
        
        // Hapus fisik file-filenya juga
        foreach($mapel->dokumens as $dok) {
            Storage::disk('public')->delete($dok->path_file);
        }
        
        $mapel->delete(); // Dokumen di DB otomatis ikut terhapus berkat onDelete('cascade')
        
        return redirect()->back()->with('success', 'Mata Pelajaran beserta seluruh dokumen di dalamnya berhasil dihapus!');
    }

    public function destroyDokumen($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        // Hapus fisik file
        Storage::disk('public')->delete($dokumen->path_file);
        $dokumen->delete();
        
        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
