<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

     <livewire:actuality/>

    <livewire:dashboard.list-drafts/>

    <livewire:dashboard.pending-games />

    <livewire:dashboard.list-games />

    <livewire:dashboard.list-game-wait-result/>

    <livewire:dashboard.list-tournaments />


</x-app-layout>
