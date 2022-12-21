<div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
    <form wire:submit.prevent="save">
        <div class="py-6 px-4 space-y-6 sm:p-6">
            <div>
                <h3 class="font-custom-title text-lg leading-6 font-medium text-gray-900">
                    Éditer le type
                </h3>
            </div>
            <div class="grid grid-cols-2 ">
                @for($i = 0; $i < count($game->users) ;$i++ )
                    <div class="col-span-3 sm:col-span-2">
                        <div class="grid grid-cols-4  items-center">
                            <img class="h-10 w-10 rounded-full"
                                 src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                 alt="">
                            <label for="gameType.label"
                                   class=" pt-2 font-medium text-gray-700">{{$game->users[$i]->name}}</label>

                            <div class="mt-1 relative rounded-md shadow-sm">

                                <select wire:change="updatePlayerResult({{$game->users[$i]->id}})"
                                        wire:model='playerSelect.{{$game->users[$i]->id}}' id="selectElement{{$game->users[$i]->id}}"
                                        class="mt-1 block w-100 h-10 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select Result</option>
                                    <option value="{{\App\Enums\GameResultEnum::win->value}}">{{\App\Enums\GameResultEnum::win->name}}</option>
                                    <option value="{{\App\Enums\GameResultEnum::lose->value}}">{{\App\Enums\GameResultEnum::lose->name}}</option>
                                    <option value="{{\App\Enums\GameResultEnum::pat->value}}">{{\App\Enums\GameResultEnum::pat->name}}</option>
                                    <option value="{{\App\Enums\GameResultEnum::nul->value}}">{{\App\Enums\GameResultEnum::nul->name}}</option>
                                </select>
                            </div>
                        </div>
                        @error('gameType.label')
                        <p class="mt-2 text-sm text-red-600" id="label-error">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                @endfor
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
