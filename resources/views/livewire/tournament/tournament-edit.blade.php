<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-center">
                    <h3>{{ $tournament->name }}</h3>
                </div>
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Information du tournoi</h3>
                                <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive
                                    mail.</p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <div class="flex flex-col mt-6">
                                <div class="overflow-x-auto">
                                    <div class="py-2 align-middle inline-block min-w-full">
                                        <div class="relative">
                                            <div class=" max-h-screen shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                                                <form wire:submit.prevent="save">
                                                    <div class="overflow-hidden shadow sm:rounded-md">
                                                        <div class="bg-white px-4 py-5 sm:p-6">
                                                            <div class="grid grid-cols-6 gap-6">
                                                                <div class="col-span-6 sm:col-span-3">
                                                                    <label for="tournament.name"
                                                                           class="block text-sm font-medium text-gray-700">Nom</label>
                                                                    <input
                                                                        type="text"
                                                                        name="tournament.name"
                                                                        id="tournament.name"
                                                                        wire:model.debounce.500ms="tournament.name"
                                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                                    >
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-3">
                                                                    <label for="last-name"
                                                                           class="block text-sm font-medium text-gray-700">Organisateur</label>
                                                                    <input
                                                                        type="text"
                                                                        name="last-name"
                                                                        id="last-name"
                                                                        disabled
                                                                        class="mt-1 disabled:opacity-75 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                                        value="{{$tournament->organizer->name}}"
                                                                    >
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                                                    <label for="tournament.number_of_players"
                                                                           class="block text-sm font-medium text-gray-700">Nombre
                                                                        de joueur</label>
                                                                    <input
                                                                        type="text"
                                                                        name="tournament.number_of_players"
                                                                        id="tournament.number_of_players"
                                                                        wire:model.debounce.500ms="tournament.number_of_players"
                                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                                    >
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                                    <label for="tournament.entrance_fee"
                                                                           class="block text-sm font-medium text-gray-700">Prix
                                                                        d'entrée</label>
                                                                    <input
                                                                        type="text"
                                                                        name="tournament.entrance_fee"
                                                                        id="tournament.entrance_fee"
                                                                        wire:model.debounce.500ms="tournament.entrance_fee"
                                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                                    >
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                                    <label for="tournament.game_type_id"
                                                                           class="block text-sm font-medium text-gray-700">Type
                                                                        de partie</label>
                                                                    <select
                                                                        id="tournament.game_type_id"
                                                                        name="tournament.game_type_id"
                                                                        wire:model.debounce.500ms="tournament.game_type_id"
                                                                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                                                    >
                                                                        <option value="">Choisir un type</option>
                                                                        @foreach($this->gameTypes as $gameType)
                                                                            <option
                                                                                value="{{ $gameType->id }}"> {{ $gameType->label }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                                            <button type="button"
                                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                Annuler
                                                            </button>
                                                            <button type="button"
                                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                Commencer
                                                            </button>
                                                            <button type="submit"
                                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                Sauvegarder
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hidden sm:block" aria-hidden="true">
                        <div class="py-5">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>

                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Liste des participants</h3>
                                    <p class="mt-1 text-sm text-gray-600">La liste des participants et leurs
                                        résultats.</p>
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <table class="min-w-full divide-y divide-gray-200 w-full">
                                    <thead class=" bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                            {{ __('Nom') }}
                                        </th>
                                        <th scope="col"
                                            class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                            {{ __('Victoires') }}
                                        </th>
                                        <th scope="col"
                                            class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                            {{ __('Paths') }}
                                        </th>
                                        <th scope="col"
                                            class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                            {{ __('Egalités') }}
                                        </th>
                                        <th scope="col"
                                            class="sticky top-0 bg-gray-50 px-1 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider z-10">
                                            {{ __('Défaites') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($tournament->participants as $participant)
                                        @php
                                            $positif = ($participant->pivot->wins + $participant->pivot->paths) > $participant->pivot->losses;
                                            $negatif = ($participant->pivot->wins + $participant->pivot->paths) < $participant->pivot->losses;
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
                                        <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                            {{ $participant->pivot->wins ?? "" }}
                                        </td>
                                        <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                            {{ $participant->pivot->paths ?? "-" }}
                                        </td>
                                        <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                            {{ $participant->pivot->draws ?? "-" }}
                                        </td>
                                        <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                            {{ $participant->pivot->losses ?? "-" }}
                                        </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-4 py-8" colspan="12">
                                                <div class="text-center">
                                                    <x-heroicon-o-face-frown class="mx-auto h-12 w-12 text-gray-400"/>
                                                    <h3 class="font-custom-title mt-2 text-sm font-medium text-gray-900">{{ __('Pas de participants') }}</h3>
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
        </div>
    </div>
