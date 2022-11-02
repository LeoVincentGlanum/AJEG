<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    <form wire:submit.prevent="save">
        <div class="py-6 px-4 space-y-6 sm:p-6">
            <div>
                <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900">
                    @if($creation === true)
                        Ajouter une catégorie
                    @else
                        Éditer la catégorie
                    @endif
                </h3>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                    <label for="gameType.label" class="block text-sm font-medium text-gray-700">Label</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="gameType.label"
                            name="gameType.label"
                            type="text"
                            wire:model.debounce.500ms="gameType.label"
                            @class([
                                'focus:ring-custom-primary focus:border-custom-primary block w-full sm:text-sm border-gray-300 rounded-md' => !$errors->has('gameType.label'),
                                'block w-full border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has('gameType.label')
                            ])
                        >
                    </div>
                    @error('gameType.label')
                        <p class="mt-2 text-sm text-red-600" id="label-error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="col-span-3 sm:col-span-2">
                    <label for="gameType.ratio" class="block text-sm font-medium text-gray-700">Ratio</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="gameType.ratio"
                            name="gameType.ratio"
                            type="text"
                            wire:model.debounce.500ms="gameType.ratio"
                            @class([
                                'focus:ring-custom-primary focus:border-custom-primary block w-full sm:text-sm border-gray-300 rounded-md' => !$errors->has('gameType.ratio'),
                                'block w-full border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md' => $errors->has('gameType.ratio')
                            ])
                        >
                    </div>
                    @error('gameType.ratio')
                        <p class="mt-2 text-sm text-red-600" id="ratio-error">
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
