<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 mt-10"></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    {{ __('Players') }}
                                    <div>
                                        <input wire:model="searchPlayer"
                                               class="block w-full  h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                               placeholder="Nom du joueur">
                                    </div>
                                </th>
                            </tr>
                            </thead>
                        </table>
                        <div class="flow-root" style="margin-left: 300px">
                            <ul role="list" class="-mb-8 m-3">
                                @foreach($EloRanks as $key=>$value)
                                    <li>
                                        <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                              aria-hidden="true"></span>
                                            <div class="relative flex space-x-3">
                                                <div>
                                                <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                  <img src="/img/{{$value[0]}}"  style="max-width: 150%" alt="">
                                                </span>
                                                </div>
                                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                    <div>
                                                        <div class="inline-flex">
                                                            <h2 class="mx-3">{{$key}}</h2> <span
                                                                class="inline-flex items-center rounded-md bg-indigo-100 px-2.5 py-0.5 text-sm font-medium text-indigo-800"> <x-heroicon-m-arrow-up class="h-4"/> {{\Illuminate\Support\Arr::get($value,2)}}</span>
                                                        </div>

                                                        @php
                                                            $cpt = 1;
                                                        @endphp
                                                        @foreach ($users as $user)
                                                            @if(
                                                            ($value[1] !== 0? ((int)$user->elo > $value[1]):true) &&
                                                            ($value[2] !== 0? ((int)$user->elo < $value[2]):true)
                                                             )
                                                                <livewire:game.user-rank
                                                                    :user="$user"
                                                                    :rank="$user_rank[$user->id]"
                                                                    key="{{now()}}"
                                                                />
                                                                @php $cpt ++;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
