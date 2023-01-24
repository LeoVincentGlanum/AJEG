<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My account') }}
        </h2>
    </x-slot>
    <div>
        @php
            $user = \Illuminate\Support\Facades\Auth::user()
        @endphp
        <livewire:user.profile :user="$user"/>
    </div>
</x-app-layout>
