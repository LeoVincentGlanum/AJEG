<x-app-layout>
    <header>
        <div class="max-w-[100rem] mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </header>
    <hr class="text-custom-button"/>
    <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8 py-6 flex flex-row">
        <livewire:chess.dashboard.list-ongoing-games/>
    </div>

    <livewire:chess.dashboard.open-bets-chess/>

    <livewire:chess.dashboard.list-drafts-chess/>

    <livewire:chess.dashboard.pending-games-chess/>

    <livewire:chess.dashboard.list-games-chess/>

    <livewire:chess.dashboard.list-game-wait-result-chess/>

    <livewire:chess.dashboard.list-tournaments-chess/>

</x-app-layout>

