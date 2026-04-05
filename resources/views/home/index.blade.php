@extends('layouts.main')

@section('title', 'Beranda - Dokumen XII RPL')

@section('content')

@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
  <strong class="font-bold">Berhasil!</strong>
  <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif

<div class="mb-6 mt-2">
    <!-- Kolom Pencarian Cepat -->
    <form action="{{ route('search.index') }}" method="GET" class="relative w-full shadow-sm rounded-xl overflow-hidden">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fas fa-search text-gray-400"></i>
        </span>
        <input type="text" name="q" 
               class="w-full py-3 pl-10 pr-4 bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl transition" 
               placeholder="Cari kisi-kisi (ex. MTK UTS)...">
    </form>
</div>

<!-- Daftar Dokumen Terbaru -->
<div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-bold text-gray-800">Dokumen Terbaru</h2>
    <a href="#" class="text-sm text-blue-600 font-semibold hover:underline">Lihat Semua</a>
</div>

<div class="space-y-4">
    
    @forelse($dokumens as $dok)
        @php
            // Menentukan warna dan icon berdasarkan ekstensi file (tipe_file)
            $ext = strtolower($dok->tipe_file);
            $bgColor = 'bg-gray-100'; $textColor = 'text-gray-500'; $icon = 'fa-file-alt';

            if(in_array($ext, ['pdf'])) {
                $bgColor = 'bg-red-100'; $textColor = 'text-red-500'; $icon = 'fa-file-pdf';
            } elseif(in_array($ext, ['doc', 'docx'])) {
                $bgColor = 'bg-blue-100'; $textColor = 'text-blue-500'; $icon = 'fa-file-word';
            } elseif(in_array($ext, ['xls', 'xlsx'])) {
                $bgColor = 'bg-green-100'; $textColor = 'text-green-500'; $icon = 'fa-file-excel';
            } elseif(in_array($ext, ['jpg', 'jpeg', 'png'])) {
                $bgColor = 'bg-yellow-100'; $textColor = 'text-yellow-500'; $icon = 'fa-file-image';
            }
        @endphp
        
        <!-- Dokumen Item -->
        <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank" class="block bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-start space-x-4 transition hover:bg-gray-50 cursor-pointer">
            <div class="{{ $bgColor }} p-3 rounded-lg {{ $textColor }} flex-shrink-0 w-12 h-12 flex items-center justify-center">
                <i class="fas {{ $icon }} text-xl"></i>
            </div>
            <div class="flex-1 overflow-hidden">
                <h3 class="font-bold text-md text-gray-800 line-clamp-2 leading-tight mb-1">{{ $dok->judul }}</h3>
                <p class="text-xs text-gray-500 mb-2 truncate">
                    <i class="fas fa-history mr-1"></i>{{ $dok->created_at->diffForHumans() }} • {{ $dok->ukuran_file }} KB
                </p>
                <span class="inline-block bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded font-semibold whitespace-nowrap"><i class="fas {{ $dok->mapel->icon }} mr-1"></i> {{ $dok->mapel->nama }}</span>
            </div>
            <div class="text-gray-400 self-center">
                <i class="fas fa-chevron-right"></i>
            </div>
        </a>
    @empty
        <div class="text-center py-10">
            <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 font-medium">Belum ada dokumen yang diunggah.</p>
        </div>
    @endforelse

</div>

@endsection