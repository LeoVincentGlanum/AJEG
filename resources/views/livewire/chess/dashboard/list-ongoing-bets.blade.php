<div>
    <div class="mb-[20px]">
        <span class="text-xl font-semibold">{{ __('Vos paris en cours') }}</span>
    </div>
    <div class="flex flex-col gap-y-[20px]">
        @foreach($this->bets as $bet)
            <div class="max-w-[500px] py-[20px] bg-custom-card rounded-[10px] flex flex-row gap-x-[25px] divide-x divide-custom-button">
                <div class="flex flex-col px-[20px]">
                    <div class="mb-[10px]">
                        <span class="p-[7px] text-lg font-semibold break-words">{{ 'Game #' . $bet->game->id }}</span>
                    </div>
                    @foreach($bet->game->gamePlayers as $player)
                        @if($bet->gameplayer_id === $player->id)
                            <div class="p-[7px] bg-custom-nav rounded-[20px]">
                                <span class="text-lg font-semibold break-words">{{ $player->user->name ?? '-' }}</span>
                            </div>
                        @else
                            <div class="p-[7px]">
                                <span class="text-lg font-semibold break-words">{{ $player->user->name ?? '-' }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="flex flex-col gap-y-[40px] px-[20px]">
                    <div class="flex flex-col">
                        <span class="text-sm text-custom-light-text">{{ __('Gains potentiels') }}</span>
                        <span class="text-lg font-semibold break-words"> {{ $bet->bet_gain }} </span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm text-custom-light-text">{{ __('Perte potentiels') }}</span>
                        <span class="text-lg font-semibold break-words"> -{{ $bet->bet_deposit}} </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
