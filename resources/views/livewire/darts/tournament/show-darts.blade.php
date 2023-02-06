<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mt-10 sm:mt-0">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <thead class=" bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Name') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Victories') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Pats') }}
                            </th>
                            <th scope="col"
                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                {{ __('Losses') }}
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tournament->participants as $participant)
                            @php
                                $positif = $participant->isParticipantScorePositif();
                                $negatif = $participant->isParticipantScoreNegative();
                            @endphp
                            <tr
                                @class([
                                'bg-green-300' => $positif,
                                'bg-red-300' => $negatif,
                                ])
                            >
                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                    {{ $participant->name ?? "-" }}
                                </td>
                                {{--                                @dd($games)--}}
                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                    @php
                                        $winCounter = 0;
                                        foreach ($results as $result) {
                                            if ($result['user_id'] === $participant->id && $result['result']->value === "win") {
                                                $winCounter++;
                                            }
                                        }
                                    @endphp
                                    {{ $winCounter ?? "" }}
                                </td>
                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                    @php
                                        $patsCounter = 0;
                                        foreach ($results as $result) {
                                            if ($result['user_id'] === $participant->id && $result['result']->value === "pat") {
                                                $patsCounter++;
                                            }
                                        }
                                    @endphp
                                    {{ $patsCounter ?? "" }}
                                </td>
                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                    @php
                                        $lossesCounter = 0;
                                        foreach ($results as $result) {
                                            if ($result['user_id'] === $participant->id && $result['result']->value === "lose") {
                                                $lossesCounter++;
                                            }
                                        }
                                    @endphp
                                    {{ $lossesCounter ?? "" }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-8" colspan="12">
                                    <div class="text-center">
                                        <x-heroicon-o-face-frown class="mx-auto h-12 w-12 text-gray-400"/>
                                        <h3 class="font-custom-title mt-2 text-sm font-medium text-gray-900">{{ __('No participants') }}</h3>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 mt-10"></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Players') }}
                                    <div>
                                        <input wire:model="searchPlayer"
                                               class="block w-full  h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               placeholder="Nom du joueur">
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Status') }}
                                    <div>

                                        <select wire:model="searchStatus"
                                                class="mt-1 block w-100 h-10 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option value="">--{{ __('Choose a status') }}--</option>
                                            @foreach(\App\Models\Game::getStatesFor('status') as $status)
                                                <option value="{{ $status }}">{{ __("game ".$status )}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Result') }}
                                    <div>
                                        <select wire:model="searchResult"
                                                class="mt-1 block w-100 h-10 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option value="">--{{ __('Choose a result') }}--</option>
                                            @foreach(\App\Enums\GameResultEnum::cases() as $status)
                                                <option value="{{ $status->value }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    @if($searchStatus !== '' || $searchPlayer !== '' || $searchResult !== '')
                                        <button wire:click="resetFilters"
                                                class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold py-2 px-4 rounded-lg mt-4">
                                            X Reset
                                        </button>
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($pageGames as $game)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                                            <div class="flex -space-x-1 overflow-hidden">
                                                @foreach($game->users as $user)
                                                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                                                         src="{{ asset('/img_profil/'.$user->photo) }}"
                                                         alt="Photo de profil de {{$user->name}}"
                                                         onerror="this.onerror=null; this.src='/img/user-default.png'">
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @foreach($game->users as $user)
                                            <a class="inline-flex items-center hover:text-violet-600"
                                               href="profile/{{$user->id}}"
                                               class="font-medium text-gray-900">
                                                @if($user->pivot->color === "noir" ||$user->pivot->color === "blanc" )
                                                    <img class="mr-2 w-10 h-10"
                                                         src="{{asset('img/roi-'.$user->pivot->color.'-cercle.png')}}">
                                                @endif {{ $user->name . " " . $user->pivot->color }} </a>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span @class(['inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium ',
                                        'text-yellow-800 bg-yellow-100'=>$game->status == \App\ModelStates\GameStates\PlayersValidation::$name,
                                        'text-purple-800 bg-purple-100'=>$game->status == \App\ModelStates\GameStates\ResultValidations::$name,
                                        'text-indigo-800 bg-indigo-100'=>$game->status == \App\ModelStates\GameStates\InProgress::$name,
                                        'text-blue-800 bg-blue-100'=>$game->status == \App\ModelStates\GameStates\GameAccepted::$name,
                                        'text-green-800 bg-green-100'=>$game->status == \App\ModelStates\GameStates\Validate::$name,
                                        ])>
                                            {{ __($game->status->name()) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $this->gameResult($game) }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        @if($game->status == \App\ModelStates\GameStates\GameAccepted::$name || $game->status == \App\ModelStates\GameStates\PlayersValidation::$name)
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">pariez</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-5" style="    text-align-last: center;">
                                        Il n'y a pas de donnée qui correspondent aux filtres
                                        <button wire:click="resetFilters"
                                                class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold py-2 px-4 rounded-lg mt-4">
                                            Réinitialiser les filtres
                                        </button>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $pageGames->links('components.pagination',['pageGames' => $pageGames]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

