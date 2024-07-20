<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-cloak
    x-data="{ darkMode: localStorage.getItem('dark') === 'true' }"
    x-init="$watch('darkMode', (val) => localStorage.setItem('dark', val))"
    x-bind:class="{ 'dark': darkMode }"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite('resources/css/app.css')
    </head>

    <body class="bg-gray-50 font-sans antialiased dark:bg-gray-800">
        <div
            class="flex min-h-screen overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900"
        >
            <div
                id="main-content"
                class="relative h-full w-full overflow-y-auto bg-gray-50 py-2 dark:bg-gray-900"
            >
                <main class="sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
                <livewire:layout.footer />
                <p class="my-10 text-center text-sm text-gray-500">
                    &copy; 2024
                    <a href="" class="hover:underline" target="_blank">VVBC</a>
                    . All rights reserved.
                </p>
            </div>
        </div>
        @vite(['resources/js/dark-mode.js'])
    </body>
</html>
