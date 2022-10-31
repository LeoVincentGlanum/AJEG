<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon compte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card">
                <h1>Bonjour {{ Auth::user()->name }}</h1>

            </div>
        </div>
    </div>
</x-app-layout>
