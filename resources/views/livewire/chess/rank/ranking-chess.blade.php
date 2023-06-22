<x-app-layout>
    <header>
        <div class="max-w-[100rem] mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold leading-tight">
                {{ __('Classement') }}
            </h2>
        </div>
    </header>
    <hr class="text-custom-button"/>
    <div class="max-w-[100rem] mx-auto sm:px-6 lg:px-8 py-6 flex flex-row gap-x-[190px]">
        <div class="flex flex-col gap-y-[60px]">
            <livewire:chess.rank.table-rank/>
        </div>
        <div class="flex flex-col gap-y-[60px]">
            <livewire:chess.rank.more-info/>
            <livewire:chess.rank.more-info/>
        </div>
    </div>
</x-app-layout>

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
