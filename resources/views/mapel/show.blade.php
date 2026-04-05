@extends('layouts.main')

@section('title', 'Dokumen ' . $mapel->nama . ' - Dokumen XII RPL')

@section('content')
<div class="mb-6 mt-2">
    <!-- Back Button & Header -->
    <div class="flex items-center mb-6 border-b border-gray-200 pb-4">
        <a href="{{ route('mapel.index') }}" class="mr-4 text-gray-500 hover:text-indigo-600 bg-gray-100 w-10 h-10 rounded-full flex items-center justify-center transition">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="flex items-center">
            <div class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-full flex items-center justify-center mr-3 shadow-sm">
                <i class="fas {{ $mapel->icon ?? 'fa-book' }} text-xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-gray-800">{{ $mapel->nama }}</h2>
                <p class="text-xs text-gray-500 font-medium">{{ count($dokumens) }} Kisi-kisi/Dokumen dikumpulkan</p>
            </div>
        </div>
    </div>
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
                @if($dok->deskripsi)
                    <p class="text-xs text-gray-400 italic line-clamp-1">"{{ $dok->deskripsi }}"</p>
                @endif
            </div>
            <div class="text-blue-500 self-center">
                <i class="fas fa-download bg-blue-50 w-8 h-8 rounded-full flex items-center justify-center"></i>
            </div>
        </a>
    @empty
        <div class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <i class="fas fa-box-open text-gray-300 text-6xl mb-4"></i>
            <p class="text-gray-500 font-medium">Belum ada dokumen untuk pelajaran <br><b>{{ $mapel->nama }}</b></p>
        </div>
    @endforelse
</div>
@endsection