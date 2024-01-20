<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Builder</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <header>
        <!-- Navigation bar goes here -->
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <a href="/" class="text-lg font-semibold text-gray-700">Resume Builder</a>
        <div class="hidden md:flex items-center">
            <!-- Normal navigation links for medium and larger screens -->
            <a href="{{ route('resume.index') }}" class="text-gray-700 text-sm mx-3 hover:text-gray-900">Home</a>
            <!-- Authentication Links -->
        </div>
        <!-- Hamburger icon for smaller screens -->
        <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path d="M3,6h18a1,1 0 1 0 0-2H3a1,1 0 1 0 0,2Z" />
    <path d="M3,13h18a1,1 0 1 0 0-2H3a1,1 0 1 0 0,2Z" />
    <path d="M3,20h18a1,1 0 1 0 0-2H3a1,1 0 1 0 0,2Z" />
</svg>
        </button>
    </nav>
    <!-- Responsive menu for smaller screens -->
    <div id="menu" class="hidden md:visible">
        <a href="{{ route('resume.index') }}" class="block text-gray-700 text-sm mx-3 hover:text-gray-900">Home</a>
        <!-- Authentication Links -->
    </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>
    <script>
        document.getElementById('menu-btn').addEventListener('click', function() {
            document.getElementById('menu').classList.toggle('hidden');
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
