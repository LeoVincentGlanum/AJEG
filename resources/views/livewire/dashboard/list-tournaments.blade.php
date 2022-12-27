<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Vos tournois en cours
            </div>
            <div class="overflow-hidden bg-white shadow sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($tournaments as $tournament)
                        <li>
                            <a href="{{ route('game.show',['id' => $tournament->id]) }}" class="block hover:bg-gray-50">
                                <div class="flex items-center px-4 py-4 sm:px-6">
                                    <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div class="truncate">
                                            <div class="flex text-sm">
                                                <p class="truncate font-medium text-indigo-600">
                                                    {{ $tournament->label != null ? $tournament->label : 'Partie numéro ' . $tournament->id }}
                                                </p>
                                                <p class="ml-1 flex-shrink-0 font-normal text-gray-500"> {{ $tournament->status }} </p>
                                            </div>
                                            <div class="mt-2 flex">
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <x-heroicon-o-calendar class="h-6 w-6"/>
                                                    <p class="ml-2">
                                                        Créée le {{ $tournament->created_at->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex-shrink-0 sm:mt-0 sm:ml-5">
                                            <div class="flex -space-x-1 overflow-hidden">
                                                @foreach($tournament->users as $user)
                                                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white"
                                                         src="{{ asset('storage/photos/'.$user->photo) }}"
                                                         alt="Dries Vincent">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-5 flex-shrink-0">
                                        <!-- Heroicon name: mini/chevron-right -->
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <div>Vous n'avez pas de tournois en cours</div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>


