<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration Panel') }}
        </h2>
    </x-slot>

    <livewire:admin.list-game-type />
</x-app-layout>
