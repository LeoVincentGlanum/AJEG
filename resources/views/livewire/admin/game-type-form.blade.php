<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    <form wire:submit.prevent="save">
        <div class="py-6 px-4 space-y-6 sm:p-6">
            <div>
                <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900">
                    @if($creation === true)
                        {{ __('Add Game Type') }}
                    @else
                        {{ __('Edit Game Type') }}
                    @endif
                </h3>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-2">
                    <label for="gameType.label">Label</label>
                    <input
                        id="gameType.label"
                        name="gameType.label"
                        type="text"
                        wire:model.debounce.500ms="gameType.label"
                    >
                    @error('gameType.label')
                        <p class="mt-2 text-sm text-red-600" id="email-error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="col-span-3 sm:col-span-2">
                    <label for="gameType.ratio">Ratio</label>
                    <input
                        id="gameType.ratio"
                        name="gameType.ratio"
                        type="text"
                        wire:model.debounce.500ms="gameType.ratio"
                    >
                    @error('gameType.ratio')
                        <p class="mt-2 text-sm text-red-600" id="email-error">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="submit"
                class="mt-3 mx-4 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
                {{ __('Save') }}
            </button>
            <button
                type="button"
                class="mt-3 mx-4 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    </form>
</div>
