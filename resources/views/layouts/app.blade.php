<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Laravel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="font-bold text-xl text-indigo-600">LaravelApp</a>
            <div class="space-x-4 flex items-center">
                <a href="/" class="hover:text-indigo-600">Home</a>
                <a href="/profile" class="hover:text-indigo-600">Profile</a>
                <!-- Menu Kasir -->
                <a href="{{ route('pos.history') }}" class="hover:text-indigo-600 font-medium text-indigo-600">Riwayat Transaksi Saya</a>
                
                <!-- Tombol Logout POST -->
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm mt-10">
        &copy; 2026 LaravelApp. All rights reserved.
    </footer>
</body>
</html>
