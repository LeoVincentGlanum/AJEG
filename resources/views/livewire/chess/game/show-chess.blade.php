<div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-5">
        <div class="mx-auto max-w-3xl">


            <livewire:interface.interactable-advises
                mainText="l'etat de la page et n'est pas synchronisé avec le server"
                buttonText="sync"
                eventName="refresh"
                :model="$game"
                key="{{ now() }}"
            />


            <div class="overflow-hidden rounded-md border border-gray-300 bg-white">
                <ul role="list" class="divide-y divide-gray-300">
                    <li class="px-6 py-4">
                        <div>

                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Game update') }}</h3>
                            <div class="flex justify-between">
                                <p class="mt-1 max-w-2xl text-sm text-gray-500"></p>
                                <div class="flex justify-end">
                                    @if($canBeBet)
                                        <button
                                            @disabled(!$isBetAvailable)
                                            wire:click="$emit('openModal', 'chess.notifications.bet-game-chess',{{ json_encode(["game" => $game->id]) }})"
                                            class="inline-flex items-center rounded-full border border-transparent bg-indigo-600 p-3 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-ticket-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13Z"/>
                                            </svg>
                                        </button>
                                    @endif
                                    <a wire:click="$emit('openModal', 'chess.notifications.delete-game-request-chess',{{ json_encode(["game" => $game->id]) }})"
                                       class="inline-flex items-center rounded-full border border-transparent bg-indigo-600 p-3 ml-2 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                        {{ trans($game->status->name()) }}
                    </li>

                    <li class="px-6 py-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($gamePlayer as $player)
                                <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300
                                @if($game->status->equals(\App\ModelStates\GameStates\ResultValidations::class) || $game->status->equals(\App\ModelStates\GameStates\GameAccepted::class))
                                    @switch($player->player_result_validation)
                                        @case(\App\ModelStates\PlayerRecognitionResultStates\Pending::$name)
                                            bg-yellow-100
                                            @break
                                        @case(\App\ModelStates\PlayerRecognitionResultStates\Accepted::$name)
                                            bg-green-100
                                            @break
                                        @case(\App\ModelStates\PlayerRecognitionResultStates\Refused::$name)
                                            bg-red-100
                                            @break
                                        @default
                                            bg-blue-100
                                    @endswitch
                                @else
                                    @switch($player->player_participation_validation)
                                        @case(\App\ModelStates\PlayerParticipationStates\Pending::$name)
                                            bg-yellow-100
                                            @break
                                        @case(\App\ModelStates\PlayerParticipationStates\Accepted::$name)
                                            bg-green-100
                                            @break
                                        @case(\App\ModelStates\PlayerParticipationStates\Declined::$name)
                                            bg-red-100
                                            @break
                                        @default
                                            bg-blue-100
                                    @endswitch
                                 @endif

                                 px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
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
                            @endforeach
                        </div>
                    </li>
                    @if($currentUserGame !== null)
                        @if($game->status->equals(\App\ModelStates\GameStates\ResultValidations::class) && $currentUserGame->player_result_validation->equals(\App\ModelStates\PlayerRecognitionResultStates\Pending::class))
                            <li class="px-6 py-4">
                                Le resultat du match a été renseigné : <br>
                                @if($winner !== null)
                                    <div
                                        class="pointer-events-auto mt-5 mb-5 m-auto w-full max-w-sm rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                                        <div class="p-4">
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 pt-0.5">
                                                    <img class="h-10 w-10 rounded-full"
                                                         src="{{ asset('public/img/'.$winner->user->photo) }}"
                                                         alt="Photo de profil de {{$winner->user->name}}">
                                                </div>
                                                <div class="ml-3 w-0 flex-1">
                                                    <p class="text-sm font-medium text-gray-900">{{$winner->user->name}}
                                                        <span
                                                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">Win</span>
                                                    </p>
                                                    <p class="mt-1 text-sm text-gray-500">Jouant les {{$winner->color}}
                                                        s</p>
                                                    <div class="mt-4 flex">
                                                        <button type="button" wire:click.prevent="accept"
                                                                class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                            Accept
                                                        </button>
                                                        <button type="button" wire:click.prevent="decline"
                                                                class="ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                            Decline
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="ml-4 flex flex-shrink-0">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </li>
                        @else
                            <div
                                class="pointer-events-auto mt-5 mb-5 m-auto w-full max-w-sm rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                                <div class="p-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 pt-0.5">
                                            <img class="h-10 w-10 rounded-full"
                                                 src=""
                                                 alt="">
                                        </div>
                                        <div class="ml-3 w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-900"> <span
                                                    class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">{{ ucfirst($gamePlayer->first()->result) }}</span>
                                            </p>
                                            <div class="mt-4 flex">
                                                <button type="button" wire:click.prevent="accept"
                                                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    Accept
                                                </button>
                                                <button type="button" wire:click.prevent="decline"
                                                        class="ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                    Decline
                                                </button>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex flex-shrink-0">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @elseif($currentUserGame->player_result_validation->equals(\App\ModelStates\PlayerRecognitionResultStates\Accepted::class))
                        <li class="px-6 py-4">
                            Le résultat est en attente d'etre approuvé par les autres joueurs
                        </li>

                    @elseif($game->status == "inprogress")

                        <li class="px-6 py-4">
                            @php
                                $data = json_encode(["id" => $game->id]);
                            @endphp
                            <a onclick="test({{ $data }})"
                               class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Give result') }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="ml-3 bi bi-person-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    <path
                                        d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </a>
                        </li>
                    @elseif($currentUserGame->player_participation_validation->equals(\App\ModelStates\PlayerParticipationStates\Accepted::class))
                        @if($game->status->equals(\App\ModelStates\GameStates\PlayersValidation::class))
                            <li class="px-6 py-4">
                                En attente des joueurs pour commencer la partie
                            </li>
                        @endif
                        @if($game->status->equals(\App\ModelStates\GameStates\GameAccepted::class))
                            <li class="px-6 py-4">
                                <a wire:click="LaunchGame"
                                   class="inline-flex mr-2 items-center rounded-md border border-transparent bg-green-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    {{ __('Launch game') }}
                                    <x-heroicon-o-check class="ml-5 w-5"/>
                                </a>
                                {{__("After launch game the option bet will be closed")}}
                            </li>
                        @endif
                    @endif
                    @php
                        $data = json_encode(["id" => $game->id]);
                    @endphp
                    @if($game->status->equals(\App\ModelStates\GameStates\PlayersValidation::class) && $currentUserGame->player_participation_validation->equals(\App\ModelStates\PlayerParticipationStates\Pending::class))
                        <li class="px-6 py-4">
                            <a>{{__('this is an invitation to play do you want accept ?')}}</a>
                        </li>
                        <li class="px-6 py-4">
                            <a wire:click="acceptInvitation"
                               class="inline-flex items-center rounded-md border border-transparent bg-green-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Accept') }}
                                <x-heroicon-o-check class="ml-5 w-5"/>
                            </a>
                            <a wire:click="refuseInvitation"
                               class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Refuse') }}
                                <x-heroicon-o-x-mark class="ml-5 w-5"/>
                            </a>
                        </li>
                    @endif
                    @else

                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>


<script>

    function test(data) {
        console.log("ça passe !")
        console.log(data)
        window.livewire.emit('openModal', 'chess.game.result-form-chess', data);
    }


</script>
