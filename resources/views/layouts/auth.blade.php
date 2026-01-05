<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitrole - Mulai Perjalanan Sehatmu</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-fitrole.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-fitrole.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .auth-gradient {
            background: radial-gradient(circle at top right, #E0F2FE, transparent),
                        radial-gradient(circle at bottom left, #F0FDF4, #FDFBF7);
        }
    </style>
</head>

<body class="auth-gradient min-h-screen">
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <main class="bg-white/70 backdrop-blur-xl border border-white shadow-2xl rounded-3xl p-8">
                @yield('content')
            </main>

            <p class="text-center text-slate-400 text-sm mt-12">
                &copy; {{ date('Y') }} Fitrole Smart Assistant. Crafted for Health.
            </p>
        </div>
    </div>
</body>
</html>