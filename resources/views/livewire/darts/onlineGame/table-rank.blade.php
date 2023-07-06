<div class="flex justify-center items-center py-12">
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div>
                <input wire:model="searchPlayer"
                       class="block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       placeholder=" Rechercher un joueur...">
            </div>
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300 bg-white" style="background-color: white;">
                        <thead class="bg-white">
                        <tr>
                            <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Catégorie
                                <select wire:model="searchCategory">
                                    <option></option>
                                    <option>TopGame</option>
                                    <option>WorstGame</option>
                                    <option>TopRound</option>
                                    <option>WorstRound</option>
                                </select>
                            </th>
{{--                            <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">--}}
{{--                                Catégorie--}}
{{--                                <select wire:model="searchCategory">--}}
{{--                                    <option value="{{$this->category = ""}}"></option>--}}
{{--                                    <option value="{{$this->category = "TopGame"}}" >TopGame</option>--}}
{{--                                    <option value="{{$this->category = "WorstGame"}}">WorstGame</option>--}}
{{--                                    <option value="{{$this->category = "TopRound"}}">TopRound</option>--}}
{{--                                    <option value="{{$this->category = "WorstRound"}}">WorstRound</option>--}}
{{--                                </select>--}}
{{--                            </th>--}}
                            <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">
                                Utilisateur
                            </th>
                            <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Score</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($records as $record)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
{{--                                    @if($this->rank[$user->id] === 1)--}}
{{--                                        <span>--}}
{{--                                            <i class="fa-solid fa-trophy fa-2xl" style="color: #d9ba6e;"></i>--}}
{{--                                        </span>--}}
{{--                                    @elseif($this->rank[$user->id] === 2)--}}
{{--                                        <span>--}}
{{--                                            <i class="fa-solid fa-trophy fa-2xl" style="color: #d4d4d4;"></i>--}}
{{--                                        </span>--}}
{{--                                    @elseif($this->rank[$user->id] === 3)--}}
{{--                                        <span>--}}
{{--                                            <i class="fa-solid fa-trophy fa-2xl" style="color: #9D7553;"></i>--}}
{{--                                        </span>--}}
{{--                                    @endif--}}
                                    {{ $record->type }}</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 text-center"
                                    style="display: flex; align-items: center;">
                                    <img class="h-9 w-9 rounded-full" src="https://zupimages.net/up/22/50/mide.png"
                                         alt="">
                                    &nbsp;<span>{{ $record->user->name }}</span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">{{ $record->score }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $records->links() }}
            </div>
        </div>
    </div>
</div>


