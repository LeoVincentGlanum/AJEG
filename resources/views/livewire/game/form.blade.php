<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 ">
                        <div>
                            <label for="exampleInputEmail1" class="text-lg font-medium leading-6 text-gray-900">{{ __('Game name') }}</label>
                            <input
                                type="text"
                                wire:model="partyName"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            >
                        </div>

                        <div class="mt-5">
                            <label for="exampleInputEmail1" class="form-label">{{ __('Game type') }}</label>
                            <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" aria-label="Default select example">
                                @foreach($gameTypes as $gameType)
                                    <option value="">{{ $gameType->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Choose your players (at least 2)') }}</h3>
                        </div>

                        <label for="players-dropdown" class="text-lg font-medium leading-6 text-gray-900">
                            {{ __('Find your players') }}
                        </label>
                        <div class="mt-4 divide-y divide-gray-200 border-b border-gray-200">
                            <div class="form-group">
                                <div wire:ignore>
                                    <select wire:model="players" id="players-dropdown" name="players" class="form-control" multiple>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if(count($players) > 1)
                            @if(count($players) == 2)
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('White player') }}</h3>
                                @if($selectBlanc === "nul")
                                    @if($errors->has('selectBlanc'))
                                        <div class="rounded-md bg-yellow-50 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <x-heroicon-s-exclamation-triangle class="w-5 h-5 cursor-pointer text-yellow-400"/>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-yellow-800">{{ __('A field is incorrect') }}</h3>
                                                    <div class="mt-2 text-sm text-yellow-700">
                                                        <p>{{ $errors->first('selectBlanc') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <select wire:model="selectBlanc" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option value="nul">{{ __('Select white player ...') }}</option>
                                    @foreach($players as $player)
                                        <option
                                            value="{{ $users->find($player)->id }}">{{ $users->find($player)->name }} {{ __('White') }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                @foreach($players as $player)
                                    <div class="mt-5">
                                        <label for="colorPlayer{{ $player }}" class="form-label"> {{ __('Color of') }} {{ $users->find($player)->name }}</label>
                                        <input
                                            wire:model="playersColors.{{ $player }}"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                            type="text"
                                            id="colorPlayer{{ $player }}"
                                        >
                                    </div>
                                @endforeach
                                @error('playersColors')
                                <div class="rounded-md bg-yellow-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <x-heroicon-s-exclamation-triangle class="w-5 h-5 cursor-pointer text-yellow-400"/>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">{{ __('A field is incorrect') }}</h3>
                                            <div class="mt-2 text-sm text-yellow-700">
                                                <p>{{ $errors->first('playersColors') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @enderror
                            @endif

                            <h3 class="my-3"> {{ __('Game status') }} </h3>

                            <select wire:model="type" name="status" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="En attente">Demande de game</option>
                                <option value="En cours">En cours</option>
                                <option value="Terminé">Terminé</option>
                            </select>

                            @if($type === "Terminé")
                                <div class="mt-5">
                                    <label for="exampleInputEmail1">{{ __('Game date') }}</label>
                                    <input
                                        type="date"
                                        class="mt-1 block rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                        id="date"
                                    >
                                </div>

                                @error('resultat')
                                <div class="rounded-md bg-yellow-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <x-heroicon-s-exclamation-triangle class="w-5 h-5 cursor-pointer text-yellow-400"/>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">{{ __('A field is incorrect') }}</h3>
                                            <div class="mt-2 text-sm text-yellow-700">
                                                <p>{{ $errors->first('resultat') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @enderror

                                <div class="mt-5">
                                    <label for="exampleInputEmail1" class="form-label">{{ __('Game result') }}</label>
                                    <select wire:model="resultat" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-2 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option value="none"></option>
                                        @foreach($players as $player)
                                            <option value="{{ $player }}">{{ $users->find($player)->name }} {{ __('Winner') }}
                                            </option>
                                        @endforeach
                                        <option value="{{ \App\Enums\GameResultEnum::pat }}">Pat</option>
                                        <option value="{{ \App\Enums\GameResultEnum::nul }}">Nul</option>
                                    </select>
                                </div>
                            @endif
                        @else
                            <div class="rounded-md bg-red-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-s-exclamation-triangle class="w-5 h-5 cursor-pointer text-red-400"/>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">{{ __('Warning') }}</h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <p>{{ __('You must fill in at least two players') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-6 flex items-center">
                            <a type="button" href="{{ route('dashboard') }}" class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                {{ __('Back') }}
                            </a>
                            @if(count($players) > 1)
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ml-3">
                                    {{ __('Create game') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#players-dropdown').select2();
        $('#players-dropdown').on('change', function(e) {
            let data = $(this).val();
        @this.set('players', data)
        });
    });
</script>
