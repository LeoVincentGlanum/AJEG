<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My account') }}
        </h2>
    </x-slot>
    <div>
        @php
            $authUser = \Illuminate\Support\Facades\Auth::user()
        @endphp
        <livewire:user.profile :user="$authUser"/>
    </div>
</x-app-layout>
