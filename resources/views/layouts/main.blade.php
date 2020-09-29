<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="icon" href="/images/movie.webp" type="image/svg" />

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>

    <livewire:styles />

    <!-- Alpine JS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <title>Moives App</title>
</head>
<body class="bg-gray-900 text-white">
    <nav class="border-gray-800 border-b">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 py-4">
            <ul class="flex flex-col md:flex-row items-center">
                <li>
                    <a href="{{ route('movies.index') }}">
                        <img class="w-6 mx-auto mb-1" src="/images/movie.webp" alt="">
                        <span class="text-lgs uppercase">Movies App</span>
                    </a>
                </li>

                <li class="md:ml-16">
                    <a href="{{ route('movies.index') }}" class="hover:text-gray-300">Movies</a>
                </li>
                <li class="md:ml-6">
                    <a href="{{ route('tv.index') }}" class="hover:text-gray-300">TV Shows</a>
                </li>
                <li class="md:ml-6">
                    <a href="{{ route('people.index') }}" class="hover:text-gray-300">People</a>
                </li>
            </ul>

            <div class="flex items-center mt-2 md:mt-0">
                <livewire:search-dropdown />

                <div class="ml-4">
                    <a href="#">
                        <img src="/images/avatar.jpg" alt="avatar" class="rounded-full w-8 h-8">
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')

    <livewire:scripts />

    @yield('scripts')
</body>
</html>
