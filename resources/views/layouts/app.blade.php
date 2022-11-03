<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">


        <!-- Scripts -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div x-data="{ open: false }" @toast.window="open = false">
                <!-- Modal with a Livewire name update form -->
            </div>

            @if (session()->has('message'))

                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: mini/information-circle -->
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                 <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
      </svg>
                        </div>
                        <div class="ml-3 flex-1 md:flex md:justify-between">
                            <p class="text-sm text-green-700">  {!!  session('message')  !!}</p>
                            <p class="mt-3 text-sm md:mt-0 md:ml-6">
                                <a href="@if(session('message_url') != null) {{session('message_url')}} @endif" class="whitespace-nowrap font-medium text-green-700 hover:text-green-600">
                                    Details
                                    <span aria-hidden="true"> &rarr;</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
        @livewire('livewire-ui-modal')
    </body>
</html>
