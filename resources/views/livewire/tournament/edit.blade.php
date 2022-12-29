<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Tournament Information') }}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ __('You can edit the tournament data') }}</p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <div class="flex flex-col mt-6">
                                <div class="overflow-x-auto">
                                    <div class="py-2 align-middle inline-block min-w-full">
                                        <div class="relative">
                                            <div class=" max-h-screen shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                                                <form wire:submit.prevent="saveInformations">
                                                    <div class="overflow-hidden shadow sm:rounded-md">
                                                        <div class="bg-white px-4 py-5 sm:p-6">
                                                            <div class="grid grid-cols-6 gap-6">
                                                                <div class="col-span-6 sm:col-span-3">
                                                                    <label for="tournament.name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                                                                    <input
                                                                        type="text"
                                                                        name="tournament.name"
                                                                        id="tournament.name"
                                                                        {{ $isEditable ? '' : 'disabled' }}
                                                                        wire:model.debounce.500ms="tournament.name"
                                                                        @class([
                                                                            'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                                                                            'disabled:opacity-75' => $isEditable === false,
                                                                        ])
                                                                    >
                                                                    @error('tournament.name')
                                                                        <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-3">
                                                                    <label for="last-name" class="block text-sm font-medium text-gray-700">{{ __('Organizer') }}</label>
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
                                                                    <label for="tournament.number_of_players" class="block text-sm font-medium text-gray-700">{{ __('Number of players') }}</label>
                                                                    <input
                                                                        type="text"
                                                                        name="tournament.number_of_players"
                                                                        id="tournament.number_of_players"
                                                                        {{ $isEditable ? '' : 'disabled' }}
                                                                        wire:model.debounce.500ms="tournament.number_of_players"
                                                                        @class([
                                                                            'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                                                                            'disabled:opacity-75' => $isEditable === false,
                                                                        ])
                                                                    >
                                                                    @error('tournament.number_of_players')
                                                                        <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                                    <label for="tournament.entrance_fee" class="block text-sm font-medium text-gray-700">{{ __('Entrance fee') }}</label>
                                                                    <input
                                                                        type="text"
                                                                        name="tournament.entrance_fee"
                                                                        id="tournament.entrance_fee"
                                                                        {{ $isEditable ? '' : 'disabled' }}
                                                                        wire:model.debounce.500ms="tournament.entrance_fee"
                                                                        @class([
                                                                            'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                                                                            'disabled:opacity-75' => $isEditable === false,
                                                                        ])
                                                                    >
                                                                    @error('tournament.entrance_fee')
                                                                        <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                                    <label for="tournament.game_type_id" class="block text-sm font-medium text-gray-700">{{ __('Game type') }}</label>
                                                                    <select
                                                                        id="tournament.game_type_id"
                                                                        name="tournament.game_type_id"
                                                                        {{ $isEditable ? '' : 'disabled' }}
                                                                        wire:model.debounce.500ms="tournament.game_type_id"
                                                                        @class([
                                                                            'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm',
                                                                            'disabled:opacity-75' => $isEditable === false,
                                                                        ])
                                                                    >
                                                                        <option value="">{{ __('Choose a type') }}</option>
                                                                        @foreach($this->gameTypes as $gameType)
                                                                            <option
                                                                                value="{{ $gameType->id }}"> {{ $gameType->label }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('tournament.game_type_id')
                                                                        <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                            {{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                                            @if($isCancelable)
                                                                <button
                                                                    type="button"
                                                                    wire:click="cancel"
                                                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                    {{ __('Cancel') }}
                                                                </button>
                                                                @if($isEditable)
                                                                    <button
                                                                        type="button"
                                                                        wire:click="start"
                                                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                        {{ __('Start') }}
                                                                    </button>
                                                                    <button
                                                                        type="submit"
                                                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                        {{ __('Submit') }}
                                                                    </button>
                                                                @endif
                                                            @endif
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
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Participants list') }}</h3>
                                    <p class="mt-1 text-sm text-gray-600">{{ __('List of participants and their results') }}</p>
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
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
                                                {{ __('Draws') }}
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
                                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                {{ $participant->pivot->wins ?? "" }}
                                            </td>
                                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center">
                                                {{ $participant->pivot->pats ?? "-" }}
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

                    @if($isStarted)
                        <div class="hidden sm:block" aria-hidden="true">
                            <div class="py-5">
                                <div class="border-t border-gray-200"></div>
                            </div>
                        </div>

                        <div class="mt-10 sm:mt-0">
                            <div class="md:grid md:grid-cols-3 md:gap-6">
                                <div class="md:col-span-1">
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Register a result') }}</h3>
                                        <p class="mt-1 text-sm text-gray-600">{{ __('You can fill in the results of the games') }}</p>
                                    </div>
                                </div>
                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <div class="flex flex-col mt-6">
                                        <div class="overflow-x-auto">
                                            <div class="py-2 align-middle inline-block min-w-full">
                                                <div class="relative">
                                                    <div class=" max-h-screen shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                                                        <form wire:submit.prevent="saveResults">
                                                            <div class="overflow-hidden shadow sm:rounded-md">
                                                                <div class="bg-white px-4 py-5 sm:p-6">
                                                                    <div class="grid grid-cols-6 gap-6">
                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="game.player1.id" class="block text-sm font-medium text-gray-700"> {{ __('Player') }} 1</label>
                                                                            <select
                                                                                id="game.player1.id"
                                                                                name="game.player1.id"
                                                                                wire:model.debounce.500ms="game.player1.id"
                                                                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                                                            >
                                                                                <option value="">{{ __('Choose a player') }}</option>
                                                                                @foreach($this->players as $player)
                                                                                    <option
                                                                                        value="{{ $player->id }}"> {{ $player->name }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('game.player1.id')
                                                                            <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                                {{ $message }}
                                                                            </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="game.player1.result" class="block text-sm font-medium text-gray-700">{{ __('Result') }}</label>
                                                                            <select
                                                                                id="game.player1.result"
                                                                                name="game.player1.result"
                                                                                wire:model.debounce.500ms="game.player1.result"
                                                                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                                                            >
                                                                                <option value="">{{ __('Choose a result') }}</option>
                                                                                @foreach(\App\Enums\GameResultEnum::cases() as $result)
                                                                                    <option
                                                                                        value="{{ $result->value }}"> {{ $result->name }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('game.player1.result')
                                                                            <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                                {{ $message }}
                                                                            </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="game.player2.id" class="block text-sm font-medium text-gray-700">{{ __('Player') }} 2</label>
                                                                            <select
                                                                                id="game.player2.id"
                                                                                name="game.player2.id"
                                                                                wire:model.debounce.500ms="game.player2.id"
                                                                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                                                            >
                                                                                <option value="">{{ __('Choose a player') }}</option>
                                                                                @foreach($this->players as $player)
                                                                                    <option value="{{ $player->id }}"> {{ $player->name }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('game.player2.id')
                                                                            <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                                {{ $message }}
                                                                            </p>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                                                            <label for="game.player2.result" class="block text-sm font-medium text-gray-700">{{ __('Result') }}</label>
                                                                            <select
                                                                                id="game.player2.result"
                                                                                name="game.player2.result"
                                                                                wire:model.debounce.500ms="game.player2.result"
                                                                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                                                            >
                                                                                <option value="">{{ __('Choose a result') }}</option>
                                                                                @foreach(\App\Enums\GameResultEnum::cases() as $result)
                                                                                    <option value="{{ $result->value }}"> {{ $result->name }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('game.player2.result')
                                                                            <p class="mt-2 text-sm text-red-600" id="label-error">
                                                                                {{ $message }}
                                                                            </p>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                                                    <button
                                                                        type="submit"
                                                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                        {{ __('Submit') }}
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
