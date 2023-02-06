<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Vos brouillons
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
                                        <a href="{{ route('chess.game.create',['game' => $game->id]) }}"
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

                                            @php
                                                $data = json_encode(["id" => $game->id]);
                                            @endphp

                                            <button onclick="return false;"
                                                    wire:click="$emit('openModal', 'chess.game.delete-draft-chess' , {{$data}})"
                                                    type="button"
                                                    class="mr-[50px] inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Supprimer
                                                <x-heroicon-s-trash class="h-5 w-5"/>
                                            </button>
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


