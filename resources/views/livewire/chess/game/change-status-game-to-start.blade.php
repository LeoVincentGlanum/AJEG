<div class="w-fit">
    <div class="mb-[20px]">
        <span class="text-xl font-semibold">{{ __('Démarrer une partie') }}</span>
    </div>
    @foreach($this->games as $game)
        <div class="max-w-[500px] p-[20px] bg-custom-card rounded-[10px] align-content-center mb-2">
            <p>Démarrer la partie contre <span class="text-custom-light-text font-semibold">{{$this->getNameOpponent($game)}}</span></p>

            <div class="mt-[15px] flex justify-center">
                <button
                    wire:click="acceptInvitation({{$game->id}})"
                    class="text-sm font-semibold bg-custom-darker-button text-custom-white px-[12px] py-[5px] rounded-[5px]"
                >
                    {{ __('DEMARRER') }}
                </button>
            </div>
        </div>
    @endforeach
</div>
