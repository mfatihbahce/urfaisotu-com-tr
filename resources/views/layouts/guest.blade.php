<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#0d9488', dark: '#0f766e', light: '#14b8a6' },
                        cream: '#f5f1e8',
                    },
                },
            },
        };
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
</head>
<body class="font-['Plus_Jakarta_Sans',sans-serif] antialiased min-h-screen" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="min-h-screen flex">
        {{-- Sol panel - Marka / Görsel --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-dark to-primary p-12 flex-col justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-white tracking-tight">IstanbulSpice</a>
            <div>
                <h1 class="text-3xl font-bold text-white mb-4">Doğal Baharatların Adresi</h1>
                <p class="text-white/90 text-lg max-w-sm">İstanbul'dan dünyaya uzanan premium baharat koleksiyonu ile mutfağınıza lezzet katın.</p>
            </div>
            <p class="text-white/60 text-sm">&copy; {{ date('Y') }} IstanbulSpice</p>
        </div>

        {{-- Sağ panel - Form --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center bg-cream px-6 sm:px-12 py-12">
            <div class="lg:hidden mb-8">
                <a href="{{ route('home') }}" class="text-xl font-bold text-primary-dark">IstanbulSpice</a>
            </div>

            <div class="w-full max-w-md mx-auto">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
