<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <livewire:actuality/>

    <livewire:darts.dashboard.open-bets-darts/>

    <livewire:darts.dashboard.list-drafts-darts/>

    <livewire:darts.dashboard.pending-games-darts/>

    <livewire:darts.dashboard.list-games-darts/>

    <livewire:darts.dashboard.list-game-wait-result-darts/>

    <livewire:darts.dashboard.list-tournaments-darts/>


</x-app-layout>
