<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bet on that game') }}
        </h2>
    </x-slot>

    <livewire:game.bet :game="$game"/>
</x-app-layout>
