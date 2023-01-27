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
                                    id="game.label"
                                    type="text"
                                    wire:model.defer="game.label"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            >
                            @error('game.label')
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-5">
                            <label for="first-player-id" class="form-label"> {{ __('Choose the players') }} </label>
                            <div class="grid grid-cols-3">
                                <div class="col-span-3 sm:col-span-2">
                                    <select id="first-player-id" wire:model="players.0.id" class="form-control"
                                            wire:change="actualizePlayer(0)">
                                        <option value=""></option>
                                        @foreach($this->users->whereNotIn('id', Arr::get($players, '1.id')) as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <select id="first-player-color" wire:model="players.0.color"
                                            wire:change="giveColor(0)" class="form-control">
                                        <option value="Choisissez une couleur">Choisissez une couleur</option>
                                        @foreach($this->colors as $color => $name)
                                            <option value="{{ $color }}">{{ __($name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3 col-span-3 sm:col-span-2">
                                    <select id="second-player" wire:model="players.1.id" class="form-control"
                                            wire:change="actualizePlayer(1)">
                                        <option value=""></option>
                                        @foreach($this->users->whereNotIn('id', Arr::get($players, '0.id')) as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    <select id="second-player-color" wire:model="players.1.color"
                                            wire:change="giveColor(1)" class="form-control">
                                        <option value="Choisissez une couleur">Choisissez une couleur</option>
                                        @foreach($this->colors as $color => $name)
                                            <option value="{{ $color }}">{{ __($name) }}</option>
                                        @endforeach
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
                            <select id="status" wire:model="status"
                                    class="block w-full rounded-md border-gray-300 py-2 pr-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="{{ \App\Enums\GameStatusEnum::AskingForGame->value }}">Demande de
                                    partie
                                </option>
                                <option value="{{ \App\Enums\GameStatusEnum::Ended->value }}">Terminée</option>
                            </select>
                            @error('status')
                            <p class="mt-2 text-sm text-red-600" id="name-error">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        @if($status === \App\Enums\GameStatusEnum::draft->value || $status === \App\Enums\GameStatusEnum::AskingForGame->value)
                            <div class="mt-5">
                                <label for="exampleInputEmail1">{{__('Activate bet')}}</label>
                                <input type="checkbox"
                                       wire:model="betAvailable"
                                       class="mt-1 block  rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                        @endif

                        @if($status === \App\Enums\GameStatusEnum::Ended->value)
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
                                        <span>{{Arr::get($players,'0.name') ?? "Player 1"}} </span>
                                        <select id="resultPlayer1" wire:model="players.0.result" class="form-control"
                                                wire:change="giveResult(0)" name="resultPlayer1">
                                            <option value=""></option>
                                            @foreach(\App\Enums\GameResultEnum::cases() as $name)
                                                <option value="{{ $name }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-3 col-span-3 sm:col-span-2">
                                        <span>{{Arr::get($players,'1.name') ?? "Player 2"}} </span>
                                        <select id="second-player-result" wire:model="players.1.result"
                                                wire:change="giveResult(1)" class="form-control">
                                            <option value=""></option>
                                            @foreach(\App\Enums\GameResultEnum::cases() as $name)
                                                <option value="{{ $name }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-6 flex items-center">
                            <button type="button" wire:click="saveDraft"
                                    class="inline-flex items-center rounded-md border border-transparent bg-orange-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Save draft') }}
                            </button>
                            <button type="submit"
                                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ml-3">
                                {{ __('Create game') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
