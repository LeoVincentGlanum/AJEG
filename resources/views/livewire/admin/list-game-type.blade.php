<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-content-between">
                    <h3>Liste des categories de partie</h3>

                    @php
                        $data = json_encode(["id" => null]);
                    @endphp
                    <a
                        class="btn btn-primary px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer"
                        wire:click="$emit('openModal', 'admin.game-type-form', {{ $data }})"
                    >
                        Ajouter une catégorie
                    </a>
                </div>
                <div class="mt-3">
                    <ul class="list-group">
                        @forelse($gameTypes as $gameType)
                            <li class="list-group-item">
                                <div class="flex justify-content-between">
                                    {{ $gameType->label }} avec un ratio de {{ $gameType->ratio }}

                                    <div class="flex">
                                        @php
                                            $dataTypeEdit = json_encode(["id" => $gameType->id]);
                                        @endphp
                                        <a
                                            class="mr-2"
                                            wire:click="$emit('openModal', 'admin.game-type-form', {{ $dataTypeEdit }})"
                                        >
                                            <x-heroicon-s-pencil class="w-5 h-5 cursor-pointer text-indigo-500 hover:text-indigo-700"/>
                                        </a>

                                        @php
                                            $dataTypeDelete = json_encode(["id" => $gameType->id]);
                                        @endphp
                                        <a wire:click="$emit('openModal', 'admin.game-type-delete', {{ $dataTypeDelete }})">
                                            <x-heroicon-s-trash class="w-5 h-5 cursor-pointer text-red-500 hover:text-red-700"/>
                                        </a>
                                    </div>
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
