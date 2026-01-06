<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:site_name" content="Fitrole">
    <meta property="og:type" content="website">

    @if(View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:title" content="Fitrole - Dashboard">
        <meta property="og:image" content="{{ asset('images/default-fitrole-share.png') }}">
    @endif

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-fitrole.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-fitrole.png') }}">

    <title>Fitrole - Mulai Perjalanan Sehatmu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; }
        [x-cloak] { display: none !important; }
        
        .badge-glow {
            filter: drop-shadow(0 0 15px rgba(16, 185, 129, 0.6));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(12deg); }
            50% { transform: translateY(-5px) rotate(15deg); }
            100% { transform: translateY(0px) rotate(12deg); }
        }
    </style>
</head>

<body class="antialiased" x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
    <div class="flex min-h-screen">
        
        <aside class="hidden lg:flex w-64 flex-col fixed inset-y-0 border-r bg-white z-50">
            @include('layouts.partials.sidebar')
        </aside>

        <div class="fixed inset-0 z-[60] lg:hidden" x-show="mobileMenuOpen" x-cloak>
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl">
                @include('layouts.partials.sidebar')
            </div>
        </div>

        <div class="flex flex-col flex-1 lg:pl-64">
            <header class="sticky top-0 z-40 flex h-16 bg-white/80 backdrop-blur-md border-b">
                @include('layouts.partials.navbar')
            </header>

            <main class="flex-1 overflow-y-auto p-6 lg:p-10">
                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>