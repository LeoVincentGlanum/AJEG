<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 mt-10">Id</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Joueurs
                                    <div>
                                        <input wire:model="searchPlayer" class="block w-full  h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nom du joueur">
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                    <div>
                                        <select wire:model="searchStatus" class="mt-1 block w-100 h-10 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option value="">--Choisir un status--</option>
                                            <option value="En cours">En cours</option>
                                            <option value="En attente">En attente</option>
                                            <option value="Terminé">Terminé</option>
                                        </select>
                                    </div>

                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Résultat
                                    <div>
                                        <select wire:model="searchResult" class="mt-1 block w-100 h-10 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                            <option value="">--Choisir un résultat--</option>
                                            <option value="win">Victoire</option>
                                            <option value="lose">Défaite</option>
                                            <option value="path">Path</option>
                                            <option value="null">Null</option>
                                        </select>
                                    </div>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    @if($Result !== ''||$Status !== '' ||$Player !== '')
                                    <button wire:click="updateSearch" class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold py-2 px-4 rounded-lg mt-4">
                                        X Reset
                                    </button>
                                        @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">

                            @foreach($pageGames as $game)


                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-gray-500">{{$game->id}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @foreach($game->users as $user)
                                            <div class="font-medium text-gray-900">{{$user->name . " " . $user->pivot->color}} </div>
                                        @endforeach
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <span @class(['inline-flex rounded-full',
                                                        'bg-yellow-100'=>$game->status === 'En attente',
                                                        'bg-blue-100'=>$game->status === 'En cours',
                                                        'bg-green-100'=>$game->status === 'Terminé',
                                                         'px-2 text-xs font-semibold leading-5 text-green-800'])>{{$game->status}}</span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$this->gameResult($game)}}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">vend ton âme done argent<span class="sr-only">, Lindsay Walton</span></a>
                                    </td>
                                </tr>

                            @endforeach
                            <!-- More people... -->
                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $pageGames->links('components.pagination',['pageGames' => $pageGames]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
