<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->name) }}
        </h2>
    </x-slot>
    <div>
        <livewire:my-account.my-account : id="{{$user->id}}"/>
    </div>
</x-app-layout>
