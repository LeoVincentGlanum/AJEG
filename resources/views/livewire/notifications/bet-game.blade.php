<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    @if(true)
        <div class="mx-auto max-w-3xl">
            <div class="overflow-hidden rounded-md border border-gray-300 bg-white">
                <ul role="list" class="divide-y divide-gray-300">
                    <li class="px-6 py-4">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Bet on the game') }}</h3>
                        </div>

                    </li>

                    <li class="px-6 py-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($gamePlayer as $player)
                                <div>
                                    <div
                                        class="relative flex items-center space-x-3 rounded-lg border border-gray-300
                                        bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full"
                                                 src="{{ asset('public/img/'.$player->user->photo) }}"
                                                 alt="Photo de profil de {{$player->user->name}}">
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <a href={{ route('user.profile', ['user' => $player->user->id]) }} class="focus:outline-none">
                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                                <p class="text-sm font-medium text-gray-900">{{ $player->user->name }}</p>
                                                <p class="truncate text-sm text-gray-500">{{ __('Play as') }} {{ $player->color }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div
                                        wire:click="initBet({{$player->bet_ratio}}, {{ $player }})"
                                        class="relative flex mt-4 items-center space-x-2 rounded-lg border border-gray-300 bg-yellow-500
                                         hover:bg-yellow-600 transition 1s py-1 shadow-sm">
                                        <button wire:click="$set('showInput', true)" wire:model="ratio"
                                                class="min-w-0 flex-1">{{ $player->bet_ratio }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($showInput)
                            <div class="flex mt-5 justify-center items-center">
                                <input
                                    class="lock w-2/12 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 appearance:none"
                                    wire:change="updateGain()"
                                    wire:model.lazy="bet"
                                    type="number"
                                    id="betValue"/>
                                <img src="/img/coins.png" class="w-5 h-5 !important">
                                <span class="inline-flex fill-current"><b>x {{$ratio}}</b></span>
                            </div>
                            <div class="flex grid justify-items-start mt-5">
                                <div class="justify-items-start text-lg">
                                    Montant de <img src="/img/coins.png" class="inline-flex w-6 h-6 !important"> parié:
                                    <b>{{ $bet }}</b>
                                </div>
                                <div class="justify-items-start text-lg">
                                    Gains potentiels de <img src="/img/coins.png"
                                                             class="inline-flex w-6 h-6 !important">:
                                    <b>{{ (string)$gain }}</b>
                                </div>
                            </div>
                            <div>
                                <button
                                    @disabled(!$enableValidation || $gain === 0)
                                    class="w-full items-center mt-4 py-2 space-x-2 rounded-lg text-black bold border
                                    border-gray-300 bg-white disabled:text-gray-500 disabled:border-0 disabled:bg-gray-300
                                    hover:bg-green-600 hover:text-white transition 1s py-1 shadow-sm"
                                    wire:click="saveBet">
                                    Valider
                                </button>
                            </div>
                        @endif

                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>





