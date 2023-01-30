<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    <form wire:submit.prevent="save">
        <div class="py-6 px-4 space-y-6 sm:p-6">
            <div>
                <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900">
                    @if(!$this->bet_notif)
                        {{ __('Inscription au service SuperBet') }}
                    @else
                        {{ __('Désabonnement au service SuperBet') }}
                    @endif
                </h3>
            </div>

            @if(!$this->bet_notif)
                <p>En vous inscrivant à ce service, devenez le meilleur parieur parmi vos amis et ne ratez plus aucun match ! Recevez un e-mail chaque fois qu'un pari est disponible.</p>
            @else
                <p>En cliquant sur valider, vous ne recevrez plus d'e-mail à chaque fois qu'un pari est disponible.</p>
            @endif
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="submit"
                class="px-4 py-2 text-sm inline-flex items-center border border-transparent font-medium rounded-md shadow-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 text-white bg-indigo-500 hover:bg-indigo-700"
            >
                {{ __('Submit') }}
            </button>
            <button
                type="button"
                class="mr-2 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-custom-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                wire:click="$emit('closeModal')"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    </form>
</div>
