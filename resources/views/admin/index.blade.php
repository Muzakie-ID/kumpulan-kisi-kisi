@extends('layouts.main')

@section('title', 'Upload Kisi-Kisi - Dokumen XII RPL')

@section('content')
<div class="mb-4 mt-2">
    @if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative shadow-sm">
      <strong class="font-bold">Sukses!</strong>
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-blue-700 text-sm mb-6 flex items-start space-x-3">
        <i class="fas fa-info-circle mt-1"></i>
        <p>Gunakan menu ini untuk mengunggah <b>(upload)</b> dokumen baru ke XII RPL. Pastikan file materi benar dan formatnya didukung.</p>
    </div>

    <!-- Form Container -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3"><i class="fas fa-cloud-upload-alt mr-2 text-blue-500"></i> Upload Dokumen</h2>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm font-semibold">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Pilihan Mapel -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Mata Pelajaran</label>
                <select name="mapel_id" required class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                    <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
                    @foreach($mapels as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Judul Dokumen -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Dokumen</label>
                <input name="judul" required type="text" placeholder="Misal: Kisi-kisi UTS Genap Fisika..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
            </div>

            <!-- Catatan (Opsional) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Catatan/Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3" placeholder="Tambahkan catatan khusus kalau ada..." class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"></textarea>
            </div>

            <!-- Area Upload File -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">File Dokumen</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500 font-semibold mb-1">Klik untuk memilih file</p>
                            <p class="text-xs text-gray-400">Word, PDF, Excel, JPG, PNG (Max. 5MB)</p>
                        </div>
                        <input name="file" required type="file" id="upload-file" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" class="hidden" onchange="document.getElementById('file-status').innerText = 'File Terpilih: ' + this.files[0].name" />
                    </label>
                </div>
                <p id="file-status" class="text-blue-600 font-semibold mt-2 text-sm text-center"></p>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-md flex justify-center items-center">
                <i class="fas fa-paper-plane mr-2"></i> Publish ke Kelas
            </button>
        </form>
    </div>

    <!-- Form Tambah Mapel -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mt-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3"><i class="fas fa-plus-circle mr-2 text-green-500"></i> Tambah Mapel Baru</h2>
        <form action="{{ route('admin.storeMapel') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pelajaran</label>
                <input name="nama" required type="text" placeholder="Misal: Seni Budaya" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-green-500">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Icon (FontAwesome) - Opsional</label>
                <select name="icon" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-lg py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-green-500 font-sans">
                    <option value="fa-book">📚 Buku (Tipe Umum)</option>
                    <option value="fa-calculator">🧮 Kalkulator (MTK)</option>
                    <option value="fa-flask">🧪 Flask (Sains/Fisika)</option>
                    <option value="fa-globe-asia">🌍 Globe (IPS/Geografi)</option>
                    <option value="fa-language">🗣️ Speech (Bahasa)</option>
                    <option value="fa-palette">🎨 Palet (Seni)</option>
                    <option value="fa-laptop-code">💻 Laptop (TIK)</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-md flex justify-center items-center">
                <i class="fas fa-save mr-2"></i> Simpan Mapel
            </button>
        </form>
    </div>

    <!-- Kelola Data -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mt-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-3"><i class="fas fa-tasks mr-2 text-purple-500"></i> Kelola Data</h2>
        
        <!-- Tab: Mapel -->
        <h3 class="font-bold text-gray-700 text-md mb-3"><i class="fas fa-layer-group text-sm mr-1"></i> Daftar Mata Pelajaran</h3>
        <div class="space-y-2 mb-6 max-h-48 overflow-y-auto pr-1">
            @foreach($mapels as $mapel)
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                <span class="text-sm font-semibold text-gray-800"><i class="fas {{ $mapel->icon }} mr-2 text-gray-500"></i> {{ $mapel->nama }}</span>
                <form action="{{ route('admin.destroyMapel', $mapel->id) }}" method="POST" onsubmit="return confirm('Yakin hapus mapel ini? Semua dokumen di dalamnya akan ikut terhapus permanen loh!');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 p-2 bg-red-50 rounded-lg" title="Hapus Mapel"><i class="fas fa-trash"></i></button>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Tab: Dokumen -->
        <h3 class="font-bold text-gray-700 text-md mb-3"><i class="fas fa-file-alt text-sm mr-1"></i> Daftar Dokumen Kis-Kisi</h3>
        <div class="space-y-2 max-h-64 overflow-y-auto pr-1">
            @forelse($dokumens as $dok)
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-800 truncate" title="{{ $dok->judul }}">{{ Str::limit($dok->judul, 25) }}</p>
                    <p class="text-xs text-gray-500">{{ $dok->mapel->nama }} • {{ $dok->created_at->format('d M') }}</p>
                </div>
                <form action="{{ route('admin.destroyDokumen', $dok->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus dokumen ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 p-2 bg-red-50 rounded-lg ml-2 flex-shrink-0" title="Hapus Dokumen"><i class="fas fa-trash-alt"></i></button>
                </form>
            </div>
            @empty
            <p class="text-xs text-center p-3 text-gray-500">Belum ada dokumen.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection