<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-8 ">
                        <div>
                            <label for="exampleInputEmail1" class="text-lg font-medium leading-6 text-gray-900">Nom de
                                la partie</label>
                            <input
                                type="text"
                                wire:model="partyName"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            >
                            @error('partyName') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-5">
                            <label for="exampleInputEmail1" class="form-label">Type de partie </label>
                            <select
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                aria-label="Default select example">
                                @foreach($gameTypes as $gameType)
                                    <option value="">{{$gameType->label}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Selectionner vos joueurs : </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Cocher les joueurs présent dans la partie.
                                (minimum 2 )</p>
                        </div>
                        <label for="exampleInputEmail1" class="text-lg font-medium leading-6 text-gray-900">
                            Rechercher vos joueurs
                        </label>

                        <div class="mt-4 divide-y divide-gray-200 border-gray-200">
                            <div class="form-group">
                                <div wire:ignore>
                                    <select id="players-dropdown" name="playersId" class="form-control" multiple
                                            wire:model="playersId">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h3 class="my-3"> Status du match </h3>

                        <select wire:model="type" name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 py-2 value}}-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option
                                value="{{\App\Enums\GameStatusEnum::waiting->name}}">{{trans(\App\Enums\GameStatusEnum::waiting->value)}}</option>
                            <option
                                value="{{\App\Enums\GameStatusEnum::progress->name}}">{{trans(\App\Enums\GameStatusEnum::progress->value)}}</option>
                            <option
                                value="{{\App\Enums\GameStatusEnum::ended->name}}">{{trans(\App\Enums\GameStatusEnum::ended->value)}}</option>
                        </select>

                        @if($type === \App\Enums\GameStatusEnum::waiting->value)
                            <div class="mt-5">
                                <label for="exampleInputEmail1">{{__('Activate bet')}}</label>
                                <input type="checkbox"
                                       wire:model="selectedBets"
                                       class="mt-1 block  rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            </div>
                        @endif

                        @if($type === \App\Enums\GameStatusEnum::ended->name)
                            <div class="mt-5">
                                <label for="exampleInputEmail1">Date de la partie</label>
                                <input type="date"
                                       class="mt-1 block  rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                       id="date">
                            </div>

                            @error('resultat')
                            <div class="rounded-md bg-yellow-50 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: mini/exclamation-triangle -->
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20"
                                             fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M8.485 3.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 3.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Un champ est mal rempli</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>{{ $errors->first('resultat') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @enderror

                            <div class="mt-5">
                                <label for="exampleInputEmail1" class="form-label">Resultat de la partie</label>
                                <select
                                    class="mt-1 block w-full  rounded-md border-gray-300 py-2 pl-3 pr-2 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                                    wire:model="resultat">
                                    <option value="none"></option>
                                    @foreach($playersId as $player)
                                        <option value="{{$player}}">{{$users->find($player)->name}} Gagnant</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="mt-6 flex items-center">
                            <button type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-100 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    wire:click="gotto">Retour
                            </button>
                            <button type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-orange-100 px-4 py-2 ml-3 text-sm font-medium text-indigo-700 hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    wire:click="saveDraft">{{trans('Save draft')}}
                            </button>
                            @if(count($playersId) > 1)
                                <button type="submit"
                                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ml-3">
                                    Créer la partie
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
    $(document).ready(function () {
        $('#players-dropdown').select2();
        $('#players-dropdown').on('change', function (e) {
            let data = $(this).val();
        @this.set('playersId', data)
        });
    });
</script>
