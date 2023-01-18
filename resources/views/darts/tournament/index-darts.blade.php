<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tournaments list') }}
        </h2>
    </x-slot>

    <livewire:darts.tournament.list-tournament-darts />
</x-app-layout>
