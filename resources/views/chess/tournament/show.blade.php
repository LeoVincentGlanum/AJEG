<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $tournament->name }}
        </h2>
    </x-slot>

    <livewire:chess.tournament.show :tournament="$tournament"/>
</x-app-layout>
