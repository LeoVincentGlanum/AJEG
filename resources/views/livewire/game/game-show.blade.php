<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-5">
        <div class="mx-auto max-w-3xl">
            <div class="overflow-hidden rounded-md border border-gray-300 bg-white">
                <ul role="list" class="divide-y divide-gray-300">
                    <li class="px-6 py-4">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Mise a jour de la partie</h3>
                            <div class="flex justify-between">
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                                <a wire:click="$emit('openModal', 'notifications.delete-game-request')"
                                   class="inline-flex items-center rounded-full border border-transparent bg-indigo-600 p-3 text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        Partie {{ $game->status }}
                    </li>

                    <li class="px-6 py-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($gamePlayer as $player)
                                <div
                                    class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full"
                                             src="{{ asset('storage/photos/'.$player->user->photo) }}"
                                             alt="">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <a href={{ route('user.profile', ['id' => $player->user->id]) }} class="focus:outline-none">
                                            <span class="absolute inset-0" aria-hidden="true"></span>
                                            <p class="text-sm font-medium text-gray-900">{{ $player->user->name }}</p>
                                            <p class="truncate text-sm text-gray-500">Joue les {{ $player->color }}</p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </li>

                    <li class="px-6 py-4">
                        <a wire:click="$emit('openModal', 'game.game-result-form',{{ $game }})"
                           class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Partie joué ?
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="ml-3 bi bi-person-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
