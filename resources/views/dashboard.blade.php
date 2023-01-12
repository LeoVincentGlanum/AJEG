<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
        $participants = App\Models\TournamentParticipant::query()->where("tournament_id", 3)->pluck("user_id");
            // Initialiser un tableau pour stocker les matchs
            $matches = [];
            $participantsCount = $participants->count();

            // Boucle à travers tous les participants
            for ($i = 0; $i < $participantsCount; $i++) {
                // Boucle à travers les participants restants après le participant actuel
                for ($j = $i + 1; $j < $participantsCount; $j++) {
                    // Ajouter le match entre les deux participants au tableau des matchs
                    $matches[] = array("player1" => $participants[$i], "player2" => $participants[$j]);
                }
            }
    @endphp
    @dd($matches)
    <livewire:actuality/>

    <livewire:dashboard.open-bets/>

    <livewire:dashboard.list-drafts/>

    <livewire:dashboard.pending-games/>

    <livewire:dashboard.list-games/>

    <livewire:dashboard.list-game-wait-result/>

    <livewire:dashboard.list-tournaments/>


</x-app-layout>
