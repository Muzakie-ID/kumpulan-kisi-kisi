@extends('layouts.main')

@section('title', 'Cari Dokumen - Pustaka Kisi-Kisi')

@section('content')
<div class="mb-6 mt-2">
    <!-- Kolom Pencarian -->
    <form action="{{ route('search.index') }}" method="GET" class="relative w-full shadow-sm rounded-xl overflow-hidden mb-6">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fas fa-search text-gray-400"></i>
        </span>
        <input type="text" name="q" value="{{ $query ?? '' }}" autofocus
               class="w-full py-4 pl-10 pr-20 bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-xl transition text-md text-gray-800 font-medium" 
               placeholder="Cari kisi-kisi atau mapel...">
        <button type="submit" class="absolute inset-y-0 right-0 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
            Cari
        </button>
    </form>

    @if($query)
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-bold text-gray-600">Hasil pencarian untuk: <span class="text-gray-800">"{{ $query }}"</span></h2>
            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded-md text-xs font-semibold">{{ count($dokumens) }} Ditemukan</span>
        </div>
    @else
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-bold text-gray-600">Saran Dokumen Terakhir:</h2>
        </div>
    @endif
</div>

<div class="space-y-4">
    @forelse($dokumens as $dok)
        @php
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
                    <i class="fas fa-calendar-alt mr-1"></i>{{ $dok->created_at->format('d M Y') }} • {{ $dok->ukuran_file }} KB
                </p>
                <span class="inline-block bg-indigo-50 text-indigo-700 text-xs px-2 py-1 rounded font-semibold whitespace-nowrap"><i class="fas {{ $dok->mapel->icon }} mr-1"></i> {{ $dok->mapel->nama }}</span>
            </div>
            <div class="text-blue-500 self-center">
                <i class="fas fa-download bg-blue-50 w-8 h-8 rounded-full flex items-center justify-center"></i>
            </div>
        </a>
    @empty
        <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <i class="fas fa-search-minus text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 font-medium">Wah, tidak ada dokumen yang cocok<br>dengan pencarian "{{ $query }}".</p>
        </div>
    @endforelse
</div>
@endsection