<div>
    <div class="mb-[20px]">
        <span class="text-xl font-semibold">{{ __('Parties en cours') }}</span>
    </div>
    <div class="flex grid grid-cols-2 gap-x-[20px] gap-y-[20px]">
        @foreach($this->games as $game)
            <div class="max-w-[380px] bg-custom-card rounded-[10px] p-[20px] flex flex-col justify-between">
                <div class="flex grid grid-cols-4 gap-y-[10px]">
                    <div class="col-span-2">
                        <span class="text-lg font-semibold break-words">{{ 'Game #' . $game->id }}</span>
                    </div>
                    <div>
                        <span class="text-base text-custom-light-text">{{ __('Elo') }}</span>
                    </div>
                    <div>
                        <span class="text-base text-custom-light-text">{{ __('Cote') }}</span>
                    </div>
                    @foreach($game->gamePlayers as $player)
                        <div class="col-span-2">
                            <span class="text-lg font-semibold break-words">{{ $player->user->name ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-base">{{ $player->user->elos->first()->elo ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-base">{{ $player->bet_ratio ?? '-' }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="mt-[5px] flex justify-between">
                    <div class="self-center">
                        <p>
                            <span class="text-sm text-custom-light-text">{{ __('Points en jeu') }}</span>
                            <span class="font-semibold text-custom-text">{{ $game->bets()->sum('bet_deposit') }}</span>
                        </p>
                    </div>
                    <div class="self-center">

                    </div>
                    @php
                        $data = json_encode(['gameId' => $game->id]);
                    @endphp
                    <button
                        wire:click="$emit('openModal', 'chess.dashboard.modal-bet-form', {{ $data }})"
                        class="self-center text-sm font-semibold bg-custom-darker-button text-custom-white px-[12px] py-[5px] rounded-[5px]"
                    >
                        {{ __('PARIER') }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-[18px]">
        <span class="text-base text-custom-light-text">{{ __('Voir toutes les parties en cours') }}</span>
    </div>
</div>
