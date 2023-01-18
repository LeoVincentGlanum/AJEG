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

                        <div class="mt-4 divide-y divide-gray-200 border-b border-gray-200">
                            <div class="form-group">
                                <div wire:ignore>
                                    <select id="players-dropdown" name="playersId" class="form-control" multiple wire:model="playersId">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


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
                                    Creer la partie
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
