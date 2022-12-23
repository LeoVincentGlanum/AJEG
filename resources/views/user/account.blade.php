<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </h2>
    </x-slot>
    <div>
        <livewire:user.profile :id="{{ \Illuminate\Support\Facades\Auth::id() }}"/>
    </div>
</x-app-layout>
