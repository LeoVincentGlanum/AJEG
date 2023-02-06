<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Vos parties en attentes
            </div>
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                    style="background-color: #edf2f7">
                    @forelse($games as $game)
                        <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                            <div class="flex w-full items-center justify-between space-x-6 p-6">
                                <div class="flex-1 truncate">
                                    <div class="flex items-center space-x-3">
                                        <h2 class="truncate text-sm font-medium text-gray-900">{{ $game->label != null ? $game->label : 'Partie numéro ' . $game->id }}</h2>
                                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-0.5 text-xs font-medium text-yellow-800">{{ trans($game->status->name()) }}</span>
                                    </div>
                                    <p class="mt-1 truncate text-sm text-gray-500">Créée
                                        le {{ $game->created_at->format('d/m/Y') }}</p>
                                </div>

                                @foreach($game->users as $user)
                                    <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300"
                                         src="{{ asset('/img_profil/'.$user->photo) }}"
                                         alt="Photo de profil de {{$user->name}}"
                                         onerror="this.onerror=null; this.src='/img/user-default.png'">
                                @endforeach
                            </div>
                            <div>
                                <div class="-mt-px flex divide-x divide-gray-200">
                                    <div class="flex w-0 flex-1">
                                        <a href="{{ route('chess.game.show-chess',['game' => $game->id]) }}"
                                           class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                                            <!-- Heroicon name: mini/envelope -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                                            </svg>

                                            <span class="ml-3">Voir</span>
                                        </a>
                                    </div>
                                    @if(\Illuminate\Support\Facades\Auth::user()->admin === 1)
                                        <div class="-ml-px flex w-0 flex-1 items-center justify-center">
                                            <a wire:click="delete({{$game->id}})"
                                               class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                                                <!-- Heroicon name: mini/phone -->
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>

                                                <span class="ml-3">Supprimer</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @empty
                        <li>
                            <div class="mt-2 my-2 mx-3">Vous n'avez pas de partie en attente</div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>


