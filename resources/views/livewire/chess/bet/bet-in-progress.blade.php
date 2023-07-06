<div class="flex">
    @foreach($bets_in_progress as $bet_in_progress)
        <div class="bet-container mr-5 min-w-1/2 bg-white rounded-lg pt-4" style="background-color: white">
            <div class="flex mx-4">
                <h1 class="text-m font-semibold mb-2">{{ $bet_in_progress->label }}</h1>
                <p class="font-semibold ml-24">Cote</p>
            </div>
            @foreach($bet_in_progress->gamePlayers as $gamePlayer)
                <div class="player-info flex items-center mt-2 mx-4">
                    <div class="flex w-16">
                        <img class="h-9 w-9 rounded-full mr-3" src="{{ asset('img_profil/'.$gamePlayer->user->photo) }}" alt="">
                        <p class="font-semibold mt-1">{{ $gamePlayer->user->name }}</p>
                    </div>
                    <p class="font-semibold ml-36">{{ $gamePlayer->bet_ratio }}</p>
                </div>
                @if(!$loop->last)
                    <hr class="my-2 border-custom-button">
                @endif
            @endforeach
            <div class="flex w-full rounded-b-lg p-4 mt-2 justify-between" style="background-color: #F8F8F8">
                <div class="flex">
                    <p class="whitespace-nowrap font-semibold">
                        {{ $this->totalCoinsBet($bet_in_progress->id) }}
                    </p>
                    <img class="h-6 w-6 rounded-full" src="{{ asset('img/yellow-coins.svg') }}" alt="yellow-coin">
                </div>
                <div class="flex">
                    <div class="flex -space-x-0.5">
                        @if($this->betsPerGame($bet_in_progress->id)->count() > 3)
                            <p class="font-semibold h-6 w-6 rounded-full bg-gray-50 ring-2 ring-[#AACB58]" style="background-color: white">
                                +{{ $this->betsPerGame($bet_in_progress->id)->count() - 3 }}
                            </p>
                        @endif
                        @foreach($this->betsPerGame($bet_in_progress->id)->take(3) as $betPerGame)
                            <img class="h-6 w-6 rounded-full ring-2 ring-[#AACB58]" style="background-color: white" src="{{ asset('img_profil/'.$gamePlayer->user->photo) }}" alt="Icon joueur">
                        @endforeach
                    </div>
                </div>
                <div class="flex">
                    @php $data = json_encode(['gameId' => $bet_in_progress->id]); @endphp
                    <button wire:click="$emit('openModal', 'chess.bet.modal-bet-form', {{ $data }})"
                            type="button"
                            class="rounded-md bg-[#AACB58] px-3 py-2 text-sm font-semibold text-custom-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        {{ __('Parier') }}
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
