<x-app-layout>
    <header>
        <div class="max-w-[100rem] mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight">
                {{ __('Games') }}
            </h2>
        </div>
    </header>
    <hr class="text-custom-button"/>
    <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8 py-6 flex flex-row gap-x-[190px]">
        <div class="flex flex-col gap-y-[60px]">
            <div class="max-w-[50rem] mt-6">
                <a
                    href="{{ route('chess.game.create') }}"
                    class="self-center text-lg font-semibold bg-custom-button px-[26px] py-[10px] rounded-[5px]"
                >
                    {{ __('Creer une partie') }}
                </a>
                <p class="mt-[32px]">
                    Créer une partie vous permettra de
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                </p>
            </div>
            <livewire:chess.game.list-ongoing-games/>
        </div>
        <div>
            <livewire:chess.game.list-history/>
        </div>
    </div>
</x-app-layout>

