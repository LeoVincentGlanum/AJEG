<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                    <h3>Liste des types de partie</h3>

                    @php
                        $data = json_encode(["id" => null]);
                    @endphp
                    <a
                        class="btn px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer text-white bg-indigo-500 hover:bg-indigo-700"
                        wire:click="$emit('openModal', 'admin.game-type-form', {{ $data }})"
                    >
                        Ajouter un type
                    </a>
                </div>
                <div class="mt-3">
                    <ul class="list-none">
                        @forelse($gameTypes as $gameType)
                            <li class="mb-2 px-2 py-3 border border-gray-200 shadow-sm rounded-lg">
                                <div class="flex justify-between">
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
                                    <x-heroicon-o-face-frown class="mx-auto h-12 w-12 text-gray-400"/>
                                    <h3 class="font-custom-title mt-2 text-sm font-medium text-gray-900">
                                        {{ __('Pas de type') }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ __('Créer un type') }}
                                    </p>
                                    <div class="mt-6">
                                        @php
                                            $data = json_encode(["id" => null]);
                                        @endphp
                                        <a
                                            class="btn px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md cursor-pointer text-white bg-indigo-500 hover:bg-indigo-700"
                                            wire:click="$emit('openModal', 'admin.game-type-form', {{ $data }})"
                                        >
                                           Ajouter un type
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
