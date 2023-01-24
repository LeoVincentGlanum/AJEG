<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8">
                        <div>
                            <label for="partyName" class="text-lg font-medium leading-6 text-gray-900">Nom de la
                                partie</label>
                            <input
                                id="partyName"
                                type="text"
                                wire:model="partyName"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            >
                            @error('partyName')
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="selectedGameTypeId" class="form-label">Type de partie </label>
                            <select
                                id="selectedGameTypeId"
                                type="text"
                                wire:model="selectedGameTypeId"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($this->gameTypes as $gameType)
                                    <option value="{{ $gameType->id }}">{{ $gameType->label }}</option>
                                @endforeach
                            </select>
                            @error('selectedGameTypeId')
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="first-player-id" class="form-label"> {{ __('Choose the players') }} </label>
                            <div class="grid grid-cols-3">
                                <div class="col-span-3 sm:col-span-2">
                                    <select id="first-player-id" wire:model="players.0.id" class="form-control">
                                        <option value=""></option>
                                        @foreach($this->users->whereNotIn('id', \Illuminate\Support\Arr::get($players, '1.id')) as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <select id="first-player-color" wire:model="players.0.color" class="form-control">
                                        <option value="black">{{ __('Black') }}</option>
                                        <option value="white">{{ __('White') }}</option>
                                    </select>
                                </div>

                                <div class="mt-3 col-span-3 sm:col-span-2">
                                    <label for="second-player"></label>
                                    <select id="second-player" wire:model="players.1.id" class="form-control">
                                        <option value=""></option>
                                        @foreach($this->users->whereNotIn('id', \Illuminate\Support\Arr::get($players, '0.id')) as $user)
                                            )
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="second-player-color"></label>
                                    <select id="second-player-color" wire:model="players.1.color" class="form-control">
                                        <option value="black">{{ __('Black') }}</option>
                                        <option value="white">{{ __('White') }}</option>
                                    </select>
                                </div>
                            </div>
                            @error('players.*')
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" wire:model="status" class="block w-full rounded-md border-gray-300 py-2 pr-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="{{ \App\ModelStates\GameStates\PlayersValidation::class }}">Demande de
                                    partie
                                </option>
                                <option value="{{ \App\ModelStates\GameStates\ResultValidations::class }}">Terminée
                                </option>
                            </select>
                            @error('status')
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        @if($status === \App\ModelStates\GameStates\Draft::class || \App\ModelStates\GameStates\PlayersValidation::class)
                            <div class="mt-5">
                                <label for="exampleInputEmail1">{{__('Activate bet')}}</label>
                                <input type="checkbox"
                                       wire:model="betAvailable"
                                       class="mt-1 block  rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                        @endif

                        @if($status === \App\ModelStates\GameStates\ResultValidations::class)
                            <div class="mt-5">
                                <label for="date">{{ __('Game date') }}</label>
                                <input
                                    id="date"
                                    type="date"
                                    class="mt-1 block rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mt-5">
                                <div class="grid grid-cols-3">
                                    <div class="col-span-3 sm:col-span-2">
                                        <span>player 1</span>
                                        <select id="first-player-result" wire:model="players.0.result" class="form-control">
                                            @foreach(\App\ModelStates\GamePlayerResultState::gameFinishedResults() as $class => $name)
                                                <option value="{{ $class }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3 col-span-3 sm:col-span-2">
                                        <span>player 2</span>
                                        <select id="second-player-result" wire:model="players.1.result"
                                                class="form-control">
                                            @foreach(\App\ModelStates\GamePlayerResultState::gameFinishedResults() as $class => $name)
                                                <option value="{{ $class }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-6 flex items-center">
                            <button type="button" wire:click="saveDraft" class="inline-flex items-center rounded-md border border-transparent bg-orange-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Save draft') }}
                            </button>
                            <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ml-3">
                                {{ __('Create game') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
