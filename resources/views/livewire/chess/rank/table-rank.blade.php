{{--@php--}}
{{--    $cpt = 1;--}}
{{--@endphp--}}
{{--<div>--}}
{{--    <div class="px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="mt-8 flex flex-col">--}}
{{--            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
{{--                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">--}}
{{--                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">--}}
{{--                        <table class="min-w-full divide-y divide-gray-300">--}}
{{--                            <thead class="bg-gray-50">--}}
{{--                            <tr>--}}
{{--                                <th scope="col"--}}
{{--                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 mt-10"></th>--}}
{{--                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">--}}
{{--                                    {{ __('Players') }}--}}
{{--                                    <div>--}}
{{--                                        <input wire:model="searchPlayer"--}}
{{--                                               class="block w-full  h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"--}}
{{--                                               placeholder="Nom du joueur">--}}
{{--                                    </div>--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                        </table>--}}

{{--                        <table class="min-w-full divide-y divide-gray-300">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Position</th>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Elo Chess</th>--}}
{{--                                <th>Rank</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <tr>--}}
{{--                                    <td class="text-center">{{ $this->rank[$user->id] }}</td>--}}
{{--                                    <td class="text-center">{{ $user->name }}</td>--}}
{{--                                    <td class="text-center">{{ $this->elo_chess[$user->id] }}</td>--}}
{{--                                    <td class="text-center">@if((int)$user->elo > 2000 && (int)$user->elo < 2500)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                        <img--}}
{{--                                                                                            src="/img/King-Transparent-PNG.png"--}}
{{--                                                                                            style="max-width: 150%">--}}
{{--                                                                                    </span>--}}
{{--                                        @elseif((int)$user->elo > 1750 && (int)$user->elo < 2000)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                              <img--}}
{{--                                                                                                  src="/img/grandmaster.png"--}}
{{--                                                                                                  style="max-width: 150%">--}}
{{--                                                                                            </span>--}}
{{--                                        @elseif((int)$user->elo > 1500 && (int)$user->elo < 1750)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                              <img src="/img/diams.png"--}}
{{--                                                                                                   style="max-width: 150%">--}}
{{--                                                                                            </span>--}}
{{--                                        @elseif((int)$user->elo > 1200 && (int)$user->elo < 1500)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                            <img src="/img/rubis.png"--}}
{{--                                                                                                 style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                        @elseif((int)$user->elo > 800 && (int)$user->elo < 1200)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                          <img src="/img/gold.png"--}}
{{--                                                                                               style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                        @elseif((int)$user->elo > 499 && (int)$user->elo < 800)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                            <img src="/img/silver.jfif"--}}
{{--                                                                                                 style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                        @elseif((int)$user->elo < 499)--}}
{{--                                            <span--}}
{{--                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                          <img src="/img/charbon.jfif"--}}
{{--                                                                                               style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                @php $cpt ++;--}}
{{--                                @endphp--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    {{ $users->links() }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


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
                        <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Classement</th>
                        <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Evolution</th>
                        <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Utilisateurs</th>
                        <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Elo</th>
                        <th scope="col" class="px-8 py-3.5 text-left text-sm font-semibold text-gray-900">Rang</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($users as $user)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                    @if($this->rank[$user->id] === 1)
                                        <span>
                                            <i class="fa-solid fa-trophy fa-2xl" style="color: #d9ba6e;"></i>
                                        </span>
                                    @elseif($this->rank[$user->id] === 2)
                                        <span>
                                            <i class="fa-solid fa-trophy fa-2xl" style="color: #d4d4d4;"></i>
                                        </span>
                                    @elseif($this->rank[$user->id] === 3)
                                        <span>
                                            <i class="fa-solid fa-trophy fa-2xl" style="color: #9D7553;"></i>
                                        </span>
                                    @endif
                                    {{ $this->rank[$user->id] }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">= 0</td>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 text-center" style="display: flex; align-items: center;">
                                    <img class="h-9 w-9 rounded-full" src="https://zupimages.net/up/22/50/mide.png" alt="">
                                    &nbsp;<span>{{ $user->name }}</span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">{{ $this->elo_chess[$user->id] }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                                    @if((int)$user->elo > 2000 && (int)$user->elo < 2500)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                    <img--}}
{{--                                                                                        src="/img/King-Transparent-PNG.png"--}}
{{--                                                                                        style="max-width: 150%">--}}
{{--                                                                                </span>--}}
                                        Supreme
                                    @elseif((int)$user->elo > 1750 && (int)$user->elo < 2000)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                          <img--}}
{{--                                                                                              src="/img/grandmaster.png"--}}
{{--                                                                                              style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
                                        Grand champion
                                    @elseif((int)$user->elo > 1500 && (int)$user->elo < 1750)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                          <img src="/img/diams.png"--}}
{{--                                                                                               style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
                                        Champion
                                    @elseif((int)$user->elo > 1200 && (int)$user->elo < 1500)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                        <img src="/img/rubis.png"--}}
{{--                                                                                             style="max-width: 150%">--}}
{{--                                                                                    </span>--}}
                                        Maitre
                                    @elseif((int)$user->elo > 800 && (int)$user->elo < 1200)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                      <img src="/img/gold.png"--}}
{{--                                                                                           style="max-width: 150%">--}}
{{--                                                                                    </span>--}}
                                        Expert
                                    @elseif((int)$user->elo > 499 && (int)$user->elo < 800)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                        <img src="/img/silver.jfif"--}}
{{--                                                                                             style="max-width: 150%">--}}
{{--                                                                                    </span>--}}
                                        Intermédiaire
                                    @elseif((int)$user->elo < 499)
{{--                                        <span--}}
{{--                                            class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                      <img src="/img/charbon.jfif"--}}
{{--                                                                                           style="max-width: 150%">--}}
{{--                                                                                    </span>--}}
                                        Débutant
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>


