<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ($game->label != null) ?__('Game ').$game->label : __('Game number ').$game->id }}
            @if($game->creator !== null)
                {{ __('by') }} {{$game->creator->name}}
            @endif
        </h2>
    </x-slot>

    <livewire:darts.game.show-darts :game="$game"/>
</x-app-layout>
