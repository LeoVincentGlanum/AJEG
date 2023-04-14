<x-app-layout>
    <header>
        <div class="max-w-[100rem] mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight">
                {{ __('Create a game') }}
            </h2>
        </div>
    </header>
    <hr class="text-custom-button"/>

    <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8 py-6 flex justify-center">
        <livewire:chess.game.form />
    </div>
</x-app-layout>
