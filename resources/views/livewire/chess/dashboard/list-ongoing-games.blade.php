<div>
    <div class="mb-[20px]">
        <span class="text-xl font-semibold">{{ __('Parties en cours') }}</span>
    </div>
    <div class="flex grid grid-cols-2 gap-x-[20px] gap-y-[20px]">
        @foreach($this->games as $game)
            <div class="max-w-[380px] bg-custom-card rounded-[10px] p-[20px]">
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
{{--                <div class="mt-[20px] flex flex-wrap">--}}
{{--                    <div>--}}
{{--                        <span class="text-base text-custom-light-text">{{ __('Points en jeu') }}</span>--}}
{{--                        <span class="text-base font-semibold">{{ $game->bets()->sum('bet_deposit') }}</span>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <button class="py-[9px] px-[12px] rounded-[5px] bg-custom-text text-custom-nav text-base">--}}
{{--                            <span class="text-base font-semibold">PARIER</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        @endforeach
    </div>
</div>
