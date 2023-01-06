<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pb-3 bg-white border-b border-gray-200">
                    <livewire:game.ranking :users="$users" :page="$page"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
