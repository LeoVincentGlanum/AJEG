<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Vos brouillons
            </div>
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($games as $game)
                        <li>
                            <a href="{{ route('darts.game.create',['game' => $game->id]) }}" class="block hover:bg-gray-50">
                                <div class="flex items-center px-4 py-4 sm:px-6">
                                    <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div class="truncate">
                                            <div class="flex text-sm">
                                                <p class="truncate font-medium text-indigo-600">
                                                    {{ $game->label != null ? $game->label : 'Partie numéro ' . $game->id }}
                                                </p>
                                                <p class="ml-1 flex-shrink-0 font-normal text-gray-500">
                                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-0.5 text-xs font-medium text-yellow-800">
                                                    {{ trans($game->status->name()) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="mt-2 flex">
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <x-heroicon-o-calendar class="h-6 w-6"/>
                                                    <p class="ml-2">
                                                        Créée le {{ $game->created_at->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                         @php
                                            $data = json_encode(["id" => $game->id]);
                                        @endphp
                                        <div class="mt-4 flex sm:mt-0 sm:ml-5">
                                             <button onclick="return false;" wire:click="$emit('openModal', 'darts.game.delete-draft-darts' , {{$data}})" type="button"  class="mr-[50px] inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium leading-4 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                Supprimer <x-heroicon-s-trash  class="h-5 w-5"/>
                                            </button>
                                            <div class="flex -space-x-1 overflow-hidden">

                                                @foreach($game->users as $user)
                                                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                                                         src="{{ asset('public/img/'.$user->photo) }}"
                                                         alt="Photo de profil de {{$user->name}}">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-5 flex-shrink-0">
                                        <x-heroicon-m-chevron-right class="w-5 h-5 text-gray-400"/>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <div>Vous n'avez pas de partie en cours</div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>


