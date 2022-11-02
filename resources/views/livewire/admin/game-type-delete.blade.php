<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    @if($gameType !== null)
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <x-heroicon-o-arrow-left class="h-6 w-6 text-red-600"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Supprimer le type "{{ $gameType->label }}"
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ __('Are you sure you want to delete this item? It will be permanently removed. This action cannot be undone.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <form wire:submit.prevent="delete">
                <button
                    type="submit"
                    class="mt-3 mx-4 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    wire:click="$emit('closeModal')"
                >
                    {{ __('Delete') }}
                </button>
            </form>
            <button
                type="button"
                class="mt-3 mx-4 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    @else
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <x-heroicon-o-arrow-left class="h-6 w-6 text-red-600"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        {{ __('Oops something went wrong.') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="button"
                class="mt-3 mx-4 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    @endif
</div>
