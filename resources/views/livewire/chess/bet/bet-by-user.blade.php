<div class="flex">
    @foreach($bets_in_progress as $bet_in_progress)
        <div class="h-50 min-w-[430px] gap-x-[190px] rounded-lg mr-10" style="background-color: white">
            <div class="grid grid-cols-2 max-w-[500px] py-[20px] rounded-[10px] flex flex-row divide-x divide-custom-button">
                <div class="ml-2">
                    <h1 class="text-m font-semibold mt-2 ml-2 mb-3">{{ $bet_in_progress->game->label }}</h1>
                    @foreach($bet_in_progress->game->gamePlayers as $gamePlayer)
                        @if($bet_in_progress->gameplayer_id === $gamePlayer->id)
                            <div class="flex rounded-full mb-3 ml-2 border-2 bg-[#F8F8F8] border-[#E8E8E8]">
                                <img class="h-9 w-9 rounded-full ml-3" src="{{asset('img_profil/'.$gamePlayer->user->photo)}}" alt="">
                                <p class="whitespace-nowrap font-semibold ml-2 mt-1">{{ $gamePlayer->user->name }}</p>
                                <p class="whitespace-nowrap font-semibold ml-3 mt-1">{{ $bet_in_progress->bet_deposit }}</p>
                                <img class="h-6 w-6 rounded-full mt-1" src="{{ asset('img/yellow-coins.svg') }}" alt="yellow-coin">
                            </div>
                        @else
                            <div class="flex rounded-full mb-3 ml-2">
                                <img class="h-9 w-9 rounded-full mb-3 ml-3" src="{{ asset('img_profil/'.$gamePlayer->user->photo) }}" alt="">
                                <p class="whitespace-nowrap font-semibold ml-2 mt-1"> {{ $gamePlayer->user->name }} </p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="ml-8 pl-4 mr-5">
                    <h3 class="text-m font-semibold mt-2 ml-2 mb-2">Gains potentiels</h3>
                    <div class="ml-2 flex">
                        <div class="w-[50px]">
                            <p class="whitespace-nowrap font-semibold text-[#AACB58]">
                                +{{ $bet_in_progress->bet_gain }} &nbsp;
                            </p>
                        </div>
                        <img class="h-6 w-6 rounded-full" src="{{ asset('img/green-coins.svg') }}" alt="green-coin">
                    </div>
                    <h3 class="text-m font-semibold mt-2 ml-2 mb-2">Perte potentiels</h3>
                    <div class="ml-2 flex">
                        <div class="w-[50px]">
                            <p class="whitespace-nowrap font-semibold text-[#ED3023]">
                                -{{ $bet_in_progress->bet_deposit }} &nbsp;
                            </p>
                        </div>
                        <img class="h-6 w-6 rounded-full" src="{{ asset('img/red-coins.svg') }}" alt="red-coin">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if($bets_in_progress->count() > 2)
        Voir tous mes paris
    @endif
</div>

