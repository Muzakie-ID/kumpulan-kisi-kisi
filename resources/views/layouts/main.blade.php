<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kumpulan Kisi-Kisi Kelas')</title>
    <!-- Tailwind CSS (CDN for simplicity in early dev) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f3f4f6; }
        .bottom-nav { padding-bottom: env(safe-area-inset-bottom); }
    </style>
</head>
<body class="antialiased text-gray-800 pb-20">

    <!-- Header App -->
    <header class="bg-blue-600 text-white p-4 shadow-md sticky top-0 z-50">
        <div class="max-w-md mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold"><i class="fas fa-book-open mr-2"></i>Dokumen XII RPL</h1>
            <a href="#" class="text-white hover:text-gray-200"><i class="fas fa-bell"></i></a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-md mx-auto p-4 min-h-screen">
        @yield('content')
    </main>

    <!-- Bottom Navigation Bar -->
    <nav class="fixed bottom-0 w-full bg-white shadow-[0_-2px_10px_rgba(0,0,0,0.05)] border-t border-gray-200 z-50 bottom-nav">
        <div class="max-w-md mx-auto flex justify-between px-6 py-3 text-sm text-gray-500">
            <!-- Navigation Links -->
            <a href="{{ route('home.index') }}" class="flex flex-col items-center flex-1 {{ request()->routeIs('home.index') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                <i class="fas fa-home text-xl mb-1"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('search.index') }}" class="flex flex-col items-center flex-1 {{ request()->routeIs('search.index') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                <i class="fas fa-search text-xl mb-1"></i>
                <span>Cari</span>
            </a>
            <a href="{{ route('mapel.index') }}" class="flex flex-col items-center flex-1 {{ request()->routeIs('mapel.*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                <i class="fas fa-layer-group text-xl mb-1"></i>
                <span>Mapel</span>
            </a>
            <a href="{{ route('admin.upload') }}" class="flex flex-col items-center flex-1 {{ request()->routeIs('admin.upload') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
                <i class="fas fa-cloud-upload-alt text-xl mb-1"></i>
                <span>Upload</span>
            </a>
        </div>
    </nav>

</body>
</html>
