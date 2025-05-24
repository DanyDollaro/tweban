<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100"> <div class="min-h-screen flex items-center justify-center">
            <div class="w-full max-w-sm mx-auto p-6 bg-white shadow-lg rounded-lg">
                {{-- <div>
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto mb-4" />
                    </a>
                </div> --}}
                {{ $slot }}
            </div>
        </div>
    </body>
</html>