<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @php
        $gamePlayers = \App\Models\GamePlayer::query()->get();
//        dd($gamePlayers);
//                    foreach ($gamePlayers as $player) {
//                        if ($player->result->value->equals(\App\ModelStates\GamePlayerResultStates\Win::class)) {
//                            dd($player);
//                        }}
    @endphp
    <livewire:actuality/>

    <livewire:dashboard.open-bets/>

    <livewire:dashboard.list-drafts/>

    <livewire:dashboard.pending-games/>

    <livewire:dashboard.list-games/>

    <livewire:dashboard.list-game-wait-result/>

    <livewire:dashboard.list-tournaments/>


</x-app-layout>
