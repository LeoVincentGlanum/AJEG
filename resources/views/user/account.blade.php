<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ \Illuminate\Support\Facades\Auth::user()->name }}
        </h2>
    </x-slot>
    <div>
        @php
            $authUserId = \Illuminate\Support\Facades\Auth::id()
        @endphp
        <livewire:user.profile :id="$authUserId"/>
    </div>
</x-app-layout>
