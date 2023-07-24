<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')
    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif



    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <iframe src="/silence.mp3" allow="autoplay" id="audio"></iframe>
</div>
@livewireScripts
<script>
    window.addEventListener('DOMContentLoaded', function () {
        Echo.channel('canal-alarme')
            .listen('TestEvent', (e) => {
                console.log(e);
            });
        Echo.private('App.Models.User.1')
            .notification((notification) => {
                console.log(notification);
                let audio = new Audio('/notification.mp3')
                audio.setAttribute('muted', 'muted');
                audio.setAttribute('allow', 'autoplay');
                audio.autoplay = true;
                audio.play();
            });
    });
</script>
</body>
</html>
