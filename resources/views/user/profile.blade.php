<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $userName }}
        </h2>
    </x-slot>
    <div>
        <livewire:user.profile :id="$userId" />
    </div>
</x-app-layout>
