<x-app-layout>
    <header>
        <div class="max-w-[100rem] mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight">
                {{ __('Paris') }}
            </h2>
        </div>
    </header>
    <hr class="text-custom-button"/>
    <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8 py-6 grid grid-cols-2 gap-x-[190px]">
        <div class="flex flex-col gap-x-[60px]">
            <div class="grid gap-80">
                <div>
                    <h1 class="text-xl font-semibold mb-4">Vos mises</h1>
                    <livewire:chess.bet.bet-by-user/>
                </div>
            </div>
        </div>
        <div class="col-span-2 flex flex-col gap-x-[60px] mt-[86px]">
            <h1 class="text-xl font-semibold mb-4">Statistiques</h1>
            <div class="grid grid-cols-2">
                <div>
                    <livewire:chess.bet.bet-stats/>
                </div>
                <div>
                    <livewire:chess.bet.bet-graph/>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-x-[60px] mt-[86px]">
            <h1 class="text-xl font-semibold mb-4">En cours ({{$countGameInProgress}})</h1>
            <livewire:chess.bet.bet-in-progress/>
        </div>
    </div>
</x-app-layout>
