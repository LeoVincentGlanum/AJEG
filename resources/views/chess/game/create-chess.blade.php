<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a game') }}
        </h2>
    </x-slot>

    <livewire:chess.game.form-chess :game="$game"/>
</x-app-layout>
