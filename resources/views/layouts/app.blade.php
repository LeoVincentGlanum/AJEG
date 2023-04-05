<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        {{--select 2--}}
        <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet"/>

        <!-- Scripts -->
        <script>
            window.addEventListener('toast', event => {
                var type = event.detail.type
                var title = 'Error'
                var icon =   `<x-heroicon-o-x-circle class="w-5 h-5 text-red-500" />`;

                if (type === 'success') {
                    title = 'Success'
                    icon = `<x-heroicon-o-check-circle class="w-5 h-5 text-green-500" />`;
                }

                Swal.fire({
                    position: 'top-end',
                    html: '<div class="w-full flex flex-col items-center space-y-4 sm:items-end">'+
                        '    <div class="max-w-sm w-full bg-white rounded-lg pointer-events-auto overflow-hidden">'+
                        '        <div>'+
                        '            <div class="flex items-start">'+
                        '                <div class="flex-shrink-0">'+
                        '                       '+icon+
                        '                </div>'+
                        '                <div class="ml-3 w-0 flex-1 pt-0.5">'+
                        '                    <p class="text-sm font-medium text-gray-900">'+
                        '                        '+title+
                        '                    </p>'+
                        '                    <p class="mt-1 text-sm text-gray-500">'+
                        '                        '+ event.detail.message +
                        '                    </p>'+
                        '                </div>'+
                        '            </div>'+
                        '        </div>'+
                        '    </div>'+
                        '</div>',
                    icon: false,
                    padding: '0rem',
                    showConfirmButton: false,
                    showCloseButton: true,
                    toast: true,
                    timer: 10000
                })
            })
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased h-full bg-custom-background text-custom-text">
        <div class="min-h-screen">
            <x-navigation-layout>
                {{ $slot }}
            </x-navigation-layout>
        </div>

        @stack('modals')

        @livewireScripts
        @livewire('livewire-ui-modal')
    </body>
</html>
