<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    @if($tournament !== null)
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <x-heroicon-o-exclamation-triangle class="h-6 w-6 text-red-600"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        {{ __('Sign up for the tournament') }} "{{ $tournament->name }}"
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            {{ __('Are you sure you want to sign up for this tournament?') }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ __('The entrance fee is :entrance_fee coins', ['entrance_fee' => $tournament->entrance_fee]) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <form wire:submit.prevent="register">
                <button
                    type="submit"
                    class="px-4 py-2 text-sm inline-flex items-center border border-transparent font-medium rounded-md shadow-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-indigo-500 hover:bg-indigo-700"
                    wire:click="$emit('closeModal')"
                >
                    {{ __('Sign up') }}
                </button>
            </form>
            <button
                type="button"
                class="mr-2 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    @else
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <x-heroicon-o-face-frown class="h-6 w-6 text-red-600"/>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        {{ __('Oops, something went wrong') }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    @endif
</div>
