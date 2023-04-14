<div>
    <div class="mb-[20px]">
        <span class="text-xl font-semibold">{{ __('Historique de mes parties') }}</span>
    </div>
    <div class="flex flex-col gap-y-[20px]">
        @forelse($this->games as $game)
            <div class="max-w-[600px] bg-custom-card rounded-[10px]">
                <div class="flex flex-col p-[20px]">
                    <div class="mb-[10px]">
                        <span class="p-[7px] text-lg font-semibold break-words">{{ 'Game #' . $game->id }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-x-14">
                        @foreach($game->gamePlayers as $player)
                            <div class="p-[7px]">
                                <span class="text-lg font-semibold break-words">{{ $player->user->name ?? '-' }}</span>
                            </div>
                            <div class="p-[7px] flex justify-end">
                                <span
                                    @class([
                                        "text-lg font-semibold break-words uppercase",
                                        "text-custom-button" => $player->user_id !== \Illuminate\Support\Facades\Auth::id()
                                    ])
                                    class=
                                >{{ $player->result ?? '-' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="max-w-[600px] bg-custom-card rounded-[10px] flex flex-row gap-x-[25px] divide-x divide-custom-button">
                <div>
                    <span class="p-[20px] text-lg font-semibold break-words">{{ __('Tu n\'as pas encore terminé de partie') }}</span>
                </div>
            </div>
        @endforelse
    </div>
</div>
