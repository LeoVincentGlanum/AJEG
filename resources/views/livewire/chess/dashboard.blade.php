<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <livewire:actuality/>

    <livewire:chess.dashboard.open-bets-chess/>

    <livewire:chess.dashboard.list-drafts-chess/>

    <livewire:chess.dashboard.pending-games-chess/>

    <livewire:chess.dashboard.list-games-chess/>

    <livewire:chess.dashboard.list-game-wait-result-chess/>

    <livewire:chess.dashboard.list-tournaments-chess/>


</x-app-layout>
