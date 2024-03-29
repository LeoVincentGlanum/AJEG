<x-app-layout>
    <header>
        <div class="max-w-[100rem] mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </header>
    <hr class="text-custom-button"/>
    <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8 py-6 flex flex-row gap-x-[190px]">
        <div class="flex flex-col gap-y-[60px]">
            <livewire:chess.game.list-ongoing-games :isLimited="true" />
            <livewire:chess.tournament.list-ongoing-tournaments />
        </div>
        <div class="flex flex-col gap-y-[60px]">
            <livewire:chess.bet.list-ongoing-bets />
            <livewire:chess.notification.list-invitations />
        </div>
    </div>
</x-app-layout>

