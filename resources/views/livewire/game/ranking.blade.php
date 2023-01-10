@php
    $cpt = 1;
@endphp
<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
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

                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Elo</th>
                                <th>Rank</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{ $this->rank[$user->id] }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->elo }}</td>
                                    <td class="text-center">@if((int)$user->elo > 2000 && (int)$user->elo < 2500)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                        <img
                                                                                            src="/img/King-Transparent-PNG.png"
                                                                                            style="max-width: 150%">
                                                                                    </span>
                                        @elseif((int)$user->elo > 1750 && (int)$user->elo < 2000)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                              <img
                                                                                                  src="/img/grandmaster.png"
                                                                                                  style="max-width: 150%">
                                                                                            </span>
                                        @elseif((int)$user->elo > 1500 && (int)$user->elo < 1750)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                              <img src="/img/diams.png"
                                                                                                   style="max-width: 150%">
                                                                                            </span>
                                        @elseif((int)$user->elo > 1200 && (int)$user->elo < 1500)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                            <img src="/img/rubis.png"
                                                                                                 style="max-width: 150%">
                                                                                        </span>
                                        @elseif((int)$user->elo > 800 && (int)$user->elo < 1200)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                          <img src="/img/gold.png"
                                                                                               style="max-width: 150%">
                                                                                        </span>
                                        @elseif((int)$user->elo > 499 && (int)$user->elo < 800)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                            <img src="/img/silver.jfif"
                                                                                                 style="max-width: 150%">
                                                                                        </span>
                                        @elseif((int)$user->elo < 499)
                                            <span
                                                class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                                                                                          <img src="/img/charbon.jfif"
                                                                                               style="max-width: 150%">
                                                                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @php $cpt ++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
{{--                        <div class="flow-root" style="margin-left: 300px">--}}

{{--                            <ul role="list" class="-mb-8 m-3">--}}
{{--                                <li>--}}
{{--                                    <div class="relative pb-8">--}}
{{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
{{--                                              aria-hidden="true"></span>--}}
{{--                                        <div class="relative flex space-x-3">--}}
{{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
{{--                                                <div>--}}
{{--                                                    @php--}}
{{--                                                        $cpt = 1;--}}
{{--                                                    @endphp--}}
{{--                                                    @foreach ($users as $user)--}}
{{--                                                        <div>--}}
{{--                                                            <ul role="list" class="divide-y divide-gray-200">--}}
{{--                                                                <li class="py-4">--}}
{{--                                                                    <div class="flex space-x-3">--}}
{{--                                                                            <span--}}
{{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
{{--                                                                        <img class="h-6 w-6 rounded-full"--}}
{{--                                                                             src="{{ asset('storage/photos/'.$user->photo) }}"--}}
{{--                                                                             alt="">--}}
{{--                                                                        <div class="flex-1 space-y-1">--}}
{{--                                                                            <div--}}
{{--                                                                                class="flex items-center justify-between">--}}
{{--                                                                                <h3 class="text-sm font-medium"--}}
{{--                                                                                    style="width: 200px">{{ $user->name }}</h3>--}}
{{--                                                                                <p class="text-sm text-gray-500 mx-10 md:mx-80">{{ $user->elo }}</p>--}}
{{--                                                                            </div>--}}
{{--                                                                            <div>--}}
{{--                                                                                @if((int)$user->elo > 2000 && (int)$user->elo < 2500)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                        <img--}}
{{--                                                                                            src="/img/King-Transparent-PNG.png"--}}
{{--                                                                                            style="max-width: 150%">--}}
{{--                                                                                    </span>--}}
{{--                                                                                @elseif((int)$user->elo > 1750 && (int)$user->elo < 2000)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                              <img--}}
{{--                                                                                                  src="/img/grandmaster.png"--}}
{{--                                                                                                  style="max-width: 150%">--}}
{{--                                                                                            </span>--}}
{{--                                                                                @elseif((int)$user->elo > 1500 && (int)$user->elo < 1750)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                              <img src="/img/diams.png"--}}
{{--                                                                                                   style="max-width: 150%">--}}
{{--                                                                                            </span>--}}
{{--                                                                                @elseif((int)$user->elo > 1200 && (int)$user->elo < 1500)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                            <img src="/img/rubis.png"--}}
{{--                                                                                                 style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                                                                @elseif((int)$user->elo > 800 && (int)$user->elo < 1200)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                          <img src="/img/gold.png"--}}
{{--                                                                                               style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                                                                @elseif((int)$user->elo > 499 && (int)$user->elo < 800)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                            <img src="/img/silver.jfif"--}}
{{--                                                                                                 style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                                                                @elseif((int)$user->elo < 499)--}}
{{--                                                                                    <span--}}
{{--                                                                                        class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
{{--                                                                                          <img src="/img/charbon.jfif"--}}
{{--                                                                                               style="max-width: 150%">--}}
{{--                                                                                        </span>--}}
{{--                                                                                @endif--}}
{{--                                                                            </div>--}}
{{--                                                                            <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                        @php $cpt ++;--}}
{{--                                                        @endphp--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <div class="relative pb-8">--}}
                                {{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
                                {{--                                              aria-hidden="true"></span>--}}
                                {{--                                        <div class="relative flex space-x-3">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span--}}
                                {{--                                                    class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
                                {{--                                                  <img src="/img/grandmaster.png" style="max-width: 150%">--}}
                                {{--                                                </span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
                                {{--                                                <div>--}}
                                {{--                                                    <h2 class="mx-3">Master</h2>--}}
                                {{--                                                    @php--}}
                                {{--                                                        $cpt = 1;--}}
                                {{--                                                    @endphp--}}
                                {{--                                                    @foreach ($users as $user)--}}
                                {{--                                                        @if((int)$user->elo > 1750 && (int)$user->elo < 2000)--}}
                                {{--                                                            <div>--}}
                                {{--                                                                <ul role="list" class="divide-y divide-gray-200">--}}
                                {{--                                                                    <li class="py-4">--}}
                                {{--                                                                        <div class="flex space-x-3">--}}
                                {{--                                                                            <span--}}
                                {{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
                                {{--                                                                            <img class="h-6 w-6 rounded-full"--}}
                                {{--                                                                                 src="{{ asset('storage/photos/'.$user->photo) }}"--}}
                                {{--                                                                                 alt="">--}}
                                {{--                                                                            <div class="flex-1 space-y-1">--}}
                                {{--                                                                                <div--}}
                                {{--                                                                                    class="flex items-center justify-between">--}}
                                {{--                                                                                    <h3 class="text-sm font-medium"--}}
                                {{--                                                                                        style="width: 200px">{{ $user->name }}</h3>--}}
                                {{--                                                                                    <p class="text-sm text-gray-500 mx-10 md:mx-80">{{ $user->elo }}</p>--}}
                                {{--                                                                                </div>--}}
                                {{--                                                                                <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
                                {{--                                                                            </div>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </li>--}}
                                {{--                                                                </ul>--}}
                                {{--                                                            </div>--}}
                                {{--                                                            @php $cpt ++;--}}
                                {{--                                                            @endphp--}}
                                {{--                                                        @endif--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <div class="relative pb-8">--}}
                                {{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
                                {{--                                              aria-hidden="true"></span>--}}
                                {{--                                        <div class="relative flex space-x-3">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span--}}
                                {{--                                                    class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
                                {{--                                                  <img src="/img/diams.png" style="max-width: 150%">--}}
                                {{--                                                </span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
                                {{--                                                <div>--}}
                                {{--                                                    <h2 class="mx-3">Diamant</h2>--}}
                                {{--                                                    @php--}}
                                {{--                                                        $cpt = 1;--}}
                                {{--                                                    @endphp--}}
                                {{--                                                    @foreach ($users as $user)--}}
                                {{--                                                        @if((int)$user->elo > 1500 && (int)$user->elo < 1750)--}}
                                {{--                                                            <div>--}}
                                {{--                                                                <ul role="list" class="divide-y divide-gray-200">--}}
                                {{--                                                                    <li class="py-4">--}}
                                {{--                                                                        <div class="flex space-x-3">--}}
                                {{--                                                                            <span--}}
                                {{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
                                {{--                                                                            <img class="h-6 w-6 rounded-full"--}}
                                {{--                                                                                 src="{{ asset('storage/photos/'.$user->photo) }}"--}}
                                {{--                                                                                 alt="">--}}
                                {{--                                                                            <div class="flex-1 space-y-1">--}}
                                {{--                                                                                <div--}}
                                {{--                                                                                    class="flex items-center justify-between">--}}
                                {{--                                                                                    <h3 class="text-sm font-medium"--}}
                                {{--                                                                                        style="width: 200px">{{ $user->name }}</h3>--}}
                                {{--                                                                                    <p class="text-sm text-gray-500 mx-10 md:mx-80">{{ $user->elo }}</p>--}}
                                {{--                                                                                </div>--}}
                                {{--                                                                                <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
                                {{--                                                                            </div>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </li>--}}
                                {{--                                                                </ul>--}}
                                {{--                                                            </div>--}}
                                {{--                                                            @php $cpt ++;--}}
                                {{--                                                            @endphp--}}
                                {{--                                                        @endif--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <div class="relative pb-8">--}}
                                {{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
                                {{--                                              aria-hidden="true"></span>--}}
                                {{--                                        <div class="relative flex space-x-3">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span--}}
                                {{--                                                    class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
                                {{--                                                  <img src="/img/rubis.png" style="max-width: 150%">--}}
                                {{--                                                </span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
                                {{--                                                <div>--}}
                                {{--                                                    <h2 class="mx-3">Rubis</h2>--}}
                                {{--                                                    @foreach ($users as $user)--}}
                                {{--                                                        @if((int)$user->elo > 1200 && (int)$user->elo < 1500)--}}
                                {{--                                                            <div>--}}
                                {{--                                                                <ul role="list" class="divide-y divide-gray-200">--}}
                                {{--                                                                    <li class="py-4">--}}
                                {{--                                                                        <div class="flex space-x-3">--}}
                                {{--                                                                            <span--}}
                                {{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
                                {{--                                                                            <img class="h-6 w-6 rounded-full"--}}
                                {{--                                                                                 src="{{ asset('storage/photos/'.$user->photo) }}"--}}
                                {{--                                                                                 alt="">--}}
                                {{--                                                                            <div class="flex-1 space-y-1">--}}
                                {{--                                                                                <div--}}
                                {{--                                                                                    class="flex items-center justify-between">--}}
                                {{--                                                                                    <h3 class="text-sm font-medium"--}}
                                {{--                                                                                        style="width: 200px">{{ $user->name }}</h3>--}}
                                {{--                                                                                    <p class="text-sm text-gray-500 mx-80">{{ $user->elo }}</p>--}}
                                {{--                                                                                </div>--}}
                                {{--                                                                                <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
                                {{--                                                                            </div>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </li>--}}
                                {{--                                                                </ul>--}}
                                {{--                                                            </div>--}}
                                {{--                                                            @php $cpt ++;--}}
                                {{--                                                            @endphp--}}
                                {{--                                                        @endif--}}
                                {{--                                                    @endforeach--}}

                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <div class="relative pb-8">--}}
                                {{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
                                {{--                                              aria-hidden="true"></span>--}}
                                {{--                                        <div class="relative flex space-x-3">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span--}}
                                {{--                                                    class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
                                {{--                                                  <img src="/img/gold.png" style="max-width: 150%">--}}
                                {{--                                                </span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
                                {{--                                                <div>--}}

                                {{--                                                    <h2 class="mx-3">Gold</h2>--}}
                                {{--                                                    @foreach ($users as $user)--}}
                                {{--                                                        @if((int)$user->elo > 800 && (int)$user->elo < 1200)--}}
                                {{--                                                            <div>--}}
                                {{--                                                                <ul role="list" class="divide-y divide-gray-200">--}}
                                {{--                                                                    <li class="py-4">--}}
                                {{--                                                                        <div class="flex space-x-3">--}}
                                {{--                                                                            <span--}}
                                {{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
                                {{--                                                                            <img class="h-6 w-6 rounded-full"--}}
                                {{--                                                                                 src="{{ asset('storage/photos/'.$user->photo) }}"--}}
                                {{--                                                                                 alt="">--}}
                                {{--                                                                            <div class="flex-1 space-y-1">--}}
                                {{--                                                                                <div--}}
                                {{--                                                                                    class="flex items-center justify-between">--}}
                                {{--                                                                                    <h3 class="text-sm font-medium"--}}
                                {{--                                                                                        style="width: 200px">{{ $user->name }}</h3>--}}
                                {{--                                                                                    <p class="text-sm text-gray-500 mx-80">{{ $user->elo }}</p>--}}
                                {{--                                                                                </div>--}}
                                {{--                                                                                <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
                                {{--                                                                            </div>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </li>--}}
                                {{--                                                                </ul>--}}
                                {{--                                                            </div>--}}
                                {{--                                                            @php $cpt ++;--}}
                                {{--                                                            @endphp--}}
                                {{--                                                        @endif--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <div class="relative pb-8">--}}
                                {{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
                                {{--                                              aria-hidden="true"></span>--}}
                                {{--                                        <div class="relative flex space-x-3">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span--}}
                                {{--                                                    class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
                                {{--                                                    <img src="/img/silver.jfif" style="max-width: 150%">--}}
                                {{--                                                </span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
                                {{--                                                <div>--}}
                                {{--                                                    <h2 class="mx-3">Silver</h2>--}}
                                {{--                                                    @foreach ($users as $user)--}}
                                {{--                                                        @if((int)$user->elo > 499 && (int)$user->elo < 800)--}}
                                {{--                                                            <div>--}}
                                {{--                                                                <ul role="list" class="divide-y divide-gray-200">--}}
                                {{--                                                                    <li class="py-4">--}}
                                {{--                                                                        <div class="flex space-x-3">--}}
                                {{--                                                                            <span--}}
                                {{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
                                {{--                                                                            <img class="h-6 w-6 rounded-full"--}}
                                {{--                                                                                 src="{{ asset('storage/photos/'.$user->photo) }}"--}}
                                {{--                                                                                 alt="">--}}
                                {{--                                                                            <div class="flex-1 space-y-1">--}}
                                {{--                                                                                <div--}}
                                {{--                                                                                    class="flex items-center justify-between">--}}
                                {{--                                                                                    <h3 class="text-sm font-medium"--}}
                                {{--                                                                                        style="width: 200px">{{ $user->name }}</h3>--}}
                                {{--                                                                                    <p class="text-sm text-gray-500 mx-80">{{ $user->elo }}</p>--}}
                                {{--                                                                                </div>--}}
                                {{--                                                                                <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
                                {{--                                                                            </div>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </li>--}}
                                {{--                                                                </ul>--}}
                                {{--                                                            </div>--}}
                                {{--                                                            @php $cpt ++;--}}
                                {{--                                                            @endphp--}}
                                {{--                                                        @endif--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
                                {{--                                <li>--}}
                                {{--                                    <div class="relative pb-8">--}}
                                {{--                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"--}}
                                {{--                                              aria-hidden="true"></span>--}}
                                {{--                                        <div class="relative flex space-x-3">--}}
                                {{--                                            <div>--}}
                                {{--                                                <span--}}
                                {{--                                                    class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">--}}
                                {{--                                                  <img src="/img/charbon.jfif" style="max-width: 150%">--}}
                                {{--                                                </span>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">--}}
                                {{--                                                <div>--}}
                                {{--                                                    <h2 class="mx-3">Charbon</h2>--}}
                                {{--                                                    @foreach ($users as $user)--}}
                                {{--                                                        @if((int)$user->elo < 499)--}}
                                {{--                                                            <div>--}}
                                {{--                                                                <ul role="list" class="divide-y divide-gray-200">--}}
                                {{--                                                                    <li class="py-4">--}}
                                {{--                                                                        <div class="flex space-x-3">--}}
                                {{--                                                                            <span--}}
                                {{--                                                                                style="margin-right: 25px">{{ $user_rank[$user->id] }}</span>--}}
                                {{--                                                                            <img class="h-6 w-6 rounded-full"--}}
                                {{--                                                                                 src="{{ asset('storage/photos/'.$user->photo) }}"--}}
                                {{--                                                                                 alt="">--}}
                                {{--                                                                            <div class="flex-1 space-y-1">--}}
                                {{--                                                                                <div--}}
                                {{--                                                                                    class="flex items-center justify-between">--}}
                                {{--                                                                                    <h3 class="text-sm font-medium"--}}
                                {{--                                                                                        style="width: 200px">{{ $user->name }}</h3>--}}
                                {{--                                                                                    <p class="text-sm text-gray-500 mx-80">{{ $user->elo }}</p>--}}
                                {{--                                                                                </div>--}}
                                {{--                                                                                <p class="text-sm text-gray-500">{{ $devise ?? null }}</p>--}}
                                {{--                                                                            </div>--}}
                                {{--                                                                        </div>--}}
                                {{--                                                                    </li>--}}
                                {{--                                                                </ul>--}}
                                {{--                                                            </div>--}}
                                {{--                                                            @php $cpt ++;--}}
                                {{--                                                            @endphp--}}
                                {{--                                                        @endif--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </div>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </li>--}}
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
