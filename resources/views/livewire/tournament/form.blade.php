<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    <form wire:submit.prevent="save">
        <div class="py-6 px-4 space-y-6 sm:p-6">
            <div>
                <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900">
                    {{ __('Créer un tournoi') }}
                </h3>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                    <label for="tournament.name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="tournament.name"
                            name="tournament.name"
                            type="text"
                            wire:model.debounce.500ms="tournament.name"
                            @class([
                                'focus:ring-custom-primary focus:border-custom-primary block w-full sm:text-sm border-gray-300 rounded-md' => !$errors->has('gameType.label'),
                                'block w-full border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has('gameType.label')
                            ])
                        >
                    </div>
                    @error('tournament.name')
                    <p class="mt-2 text-sm text-red-600" id="name-error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="col-span-3 sm:col-span-2">
                    <label for="tournament.number_of_players" class="block text-sm font-medium text-gray-700">Nombre de Joueurs</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="tournament.number_of_players"
                            name="tournament.number_of_players"
                            type="number"
                            wire:model.debounce.500ms="tournament.number_of_players"
                            @class([
                                'focus:ring-custom-primary focus:border-custom-primary block w-full sm:text-sm border-gray-300 rounded-md' => !$errors->has('gameType.ratio'),
                                'block w-full border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has('gameType.ratio')
                            ])
                        >
                    </div>
                    @error('tournament.number_of_players')
                    <p class="mt-2 text-sm text-red-600" id="players-error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="col-span-3 sm:col-span-2">
                    <label for="tournament.entrance_fee" class="block text-sm font-medium text-gray-700">Prix d'Entrée</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="tournament.entrance_fee"
                            name="tournament.entrance_fee"
                            type="number"
                            wire:model.debounce.500ms="tournament.entrance_fee"
                            @class([
                        'focus:ring-custom-primary focus:border-custom-primary block w-full sm:text-sm border-gray-300 rounded-md' => !$errors->has('gameType.ratio'),
                        'block w-full border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has('gameType.ratio')
                        ])
                        >
                    </div>
                    @error('tournament.entrance_fee')
                    <p class="mt-2 text-sm text-red-600" id="fee-error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="col-span-3 sm:col-span-2">
                    <label for="selectedGameType" class="block text-sm font-medium text-gray-700">Type de partie</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <select
                            id=tournament.game_type_id"
                            name="tournament.game_type_id"
                            wire:model.debounce.500ms="tournament.game_type_id"
                            @class([
                                'focus:ring-custom-primary focus:border-custom-primary block w-full sm:text-sm border-gray-300 rounded-md' => !$errors->has('gameType.ratio'),
                                'block w-full border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has('gameType.ratio')
                            ])
                        >
                            <option value="">Choisir un type</option>
                            @foreach($this->gameTypes as $gameType)
                                <option value="{{ $gameType->id }}"> {{ $gameType->label }} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('tournament.game_type_id')
                    <p class="mt-2 text-sm text-red-600" id="type-error">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="submit"
                class="px-4 py-2 text-sm inline-flex items-center border border-transparent font-medium rounded-md shadow-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-indigo-500 hover:bg-indigo-700"
            >
                Valider
            </button>
            <button
                type="button"
                class="mr-2 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                Annuler
            </button>
        </div>
    </form>
</div>
