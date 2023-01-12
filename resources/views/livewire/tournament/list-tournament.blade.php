<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                    <h3>{{ __('Liste des tournois') }}</h3>

                    <a
                        class="btn px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer text-white bg-indigo-500 hover:bg-indigo-700"
                        wire:click="$emit('openModal', 'tournament.form')"
                    >
                        {{ __('Créer un tournoi') }}
                    </a>
                </div>
                <form
                    class="mt-1 w-full grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6"
                >
                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Type') }}
                        </label>
                        <select
                            id="type"
                            name="type"
                            wire:model.debounce.500ms="type"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="">{{ __('Choose a type') }}</option>
                            @foreach($this->types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Game type') }}
                        </label>
                        <select
                            id="gameType"
                            name="gameType"
                            wire:model.debounce.500ms="gameType"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="">{{ __('Choose a type') }}</option>
                            @foreach($this->gameTypes as $gameType)
                                <option value="{{ $gameType->id }}">{{ $gameType->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Status') }}
                        </label>
                        <select
                            id="tournamentStatus"
                            name="tournamentStatus"
                            wire:model.debounce.500ms="tournamentStatus"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="">{{ __('Choose a status') }}</option>
                            @foreach($this->status as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:col-span-1">
                        <x-form.range
                            nameMin="minElo"
                            nameMax="maxElo"
                        />
                    </div>

                    <div class="sm:col-span-2">
                        <span>&nbsp;</span>
                        <div class="flex justify-end">
                            <button
                                type="button"
                                class="mt-3 mx-4 w-full inline-flex rounded-md bg-white text-custom-primary font-medium sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                wire:click="resetFilter"
                            >
                                <x-heroicon-m-arrow-path class="w-5 h-5 text-indigo-500"/>
                                <span class="ml-1">
                                    {{ __('Reset filter') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto">
                        <div class="py-2 align-middle inline-block min-w-full">
                            <div class="relative">
                                <div class=" max-h-screen shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 w-full">
                                        <thead class=" bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Nom') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Organisateur') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Nombre de Joueurs') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Prix d\'Entrée') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Elo') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Tournament type') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Type de Partie') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Status') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Date de Début') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Date de Fin') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                                {{ __('Vainqueur') }}
                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">

                                            </th>
                                            <th scope="col"
                                                class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($tournaments as $tournament)
                                            @php
                                                $nbParticipants = $tournament->participants->count();
                                                $userIsParticipant = $tournament->participants->where('id', '=', Auth::id())->isNotEmpty();
                                                $isCanceled = $tournament->isCanceled() && $userIsParticipant;
                                            @endphp
                                            <tr
                                                @class([
                                                    'bg-green-300' => $userIsParticipant,
                                                    'bg-red-300' => $isCanceled
                                                ])
                                            >
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->name ?? "-" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->organizer->name ?? "" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $nbParticipants }} / {{ $tournament->number_of_players }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->entrance_fee ?? "-" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->getEloRequired() }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->type ?? "-" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->gameType->label ?? "-" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->status ?? "-" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->start_date ?? "-" }}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->end_date ?? "-"}}
                                                </td>
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    {{ $tournament->winner->name ?? "-"}}
                                                </td>
                                                @if($tournament->organizer_id === \Illuminate\Support\Facades\Auth::id())
                                                    <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                        <a href="{{ route('tournament.edit', ['tournament' => $tournament->id]) }}"
                                                           target="_blank">
                                                            <x-heroicon-s-pencil
                                                                class="w-5 h-5 cursor-pointer text-indigo-500 hover:text-indigo-700"/>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    @php
                                                        $data = json_encode(["id" => $tournament->id]);
                                                    @endphp
                                                    <a wire:click="$emit('openModal', 'tournament.register', {{ $data }})">
                                                        <x-heroicon-s-ticket
                                                            class="w-6 h-6 cursor-pointer text-indigo-500 hover:text-indigo-700"/>
                                                    </a>
                                                </td>
                                            </tr>
                                            @if($tournament->organizer_id === \Illuminate\Support\Facades\Auth::id() && $tournament->status == \App\ModelStates\TournamentStatusStates\FullTournament::$name)
                                                <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                    @php
                                                        $data = json_encode(["id" => $tournament->id]);
                                                    @endphp
                                                    <a wire:click="$emit('openModal', 'tournament.start', {{ $data }})">
                                                        <x-heroicon-s-play
                                                            class="w-6 h-6 cursor-pointer text-indigo-500 hover:text-indigo-700"/>
                                                    </a>
                                                </td>
                                                @endif
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td class="px-4 py-8" colspan="12">
                                                            <div class="text-center">
                                                                <x-heroicon-o-trophy
                                                                    class="mx-auto h-12 w-12 text-gray-400"/>
                                                                <h3 class="font-custom-title mt-2 text-sm font-medium text-gray-900">{{ __('Pas de tournois') }}</h3>
                                                                <div class="mt-6">
                                                                    <a
                                                                        wire:click="$emit('openModal', 'tournament.form')"
                                                                        class="btn px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer text-white bg-indigo-500 hover:bg-indigo-700"
                                                                    >
                                                                        {{ __('Créer un tournoi') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-1">
                                    {{ $tournaments->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
