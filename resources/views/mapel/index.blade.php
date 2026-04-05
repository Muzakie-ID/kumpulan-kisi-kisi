@extends('layouts.main')

@section('title', 'Mata Pelajaran - Pustaka Kisi-Kisi')

@section('content')
<div class="mb-4 mt-2">
    <div class="flex justify-between items-center mb-6 border-b pb-3">
        <h2 class="text-xl font-bold text-gray-800"><i class="fas fa-layer-group mr-2 text-indigo-500"></i> Kategori Mata Pelajaran</h2>
    </div>

    <!-- Grid Mapel -->
    <div class="grid grid-cols-2 gap-4">
        
        @forelse($mapels as $mapel)
            <a href="{{ route('mapel.show', $mapel->slug) }}" class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition hover:bg-indigo-50 hover:border-indigo-200 cursor-pointer group">
                <div class="bg-indigo-100 text-indigo-600 w-14 h-14 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas {{ $mapel->icon ?? 'fa-book' }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1">{{ $mapel->nama }}</h3>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">{{ $mapel->dokumens_count }} Dokumen</span>
            </a>
        @empty
            <div class="col-span-2 text-center py-10">
                <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 font-medium">Belum ada mata pelajaran.</p>
            </div>
        @endforelse

    </div>
</div>
@endsection