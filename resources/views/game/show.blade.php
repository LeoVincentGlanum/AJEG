<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ($game->label != null) ? "Partie ".$game->label : 'Partie numero '.$game->id }} @if($game->creator !== null) créée par {{$game->creator->name}}@endif
        </h2>
    </x-slot>

    <livewire:game.game-show :game="$game" />
</x-app-layout>
