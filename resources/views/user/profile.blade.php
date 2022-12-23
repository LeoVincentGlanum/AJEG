<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>
    <div>
        <livewire:user.profile :id="{{ $user->id }}" />
    </div>
</x-app-layout>
