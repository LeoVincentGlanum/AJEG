<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3>Liste des categories de partie</h3>

                <div class="mt-3">
                    <ul class="list-group">
                        @forelse($gameTypes as $gameType)
                            <li class="list-group-item">
                                <div style="display: flex;justify-content: space-between;">
                                    {{ $gameType->label }} avec un ratio de {{ $gameType->ratio }}

                                    @php
                                        $dataLineDelete = json_encode(["id" => $gameType->id]);
                                    @endphp
                                    <a
                                        class="btn btn-danger deleteCat"
                                        wire:click="$emit('openModal', 'admin.game-type-delete', {{ $dataLineDelete }})"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                             class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="text-center">
                                    <h3 class="font-custom-title mt-2 text-sm font-medium text-gray-900">{{ __('Pas de categories') }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('Créer une catégorie') }}
                                    </p>
                                    <div class="mt-6">
                                        @php
                                            $data = json_encode(["id" => null]);
                                        @endphp
                                        <a
                                            class="btn btn-primary inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer"
                                            wire:click="$emit('openModal', 'admin.game-type-form', {{ $data }})"
                                        >
                                           Ajouter une catégorie
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
