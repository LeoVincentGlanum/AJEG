<div>
    @php
        $config = \Illuminate\Support\Arr::first($tabs, fn($value) => \Illuminate\Support\Arr::get($value, 'name') === $tab);
        $name = Arr::get($config, 'name');
        $component = \Illuminate\Support\Arr::get($config, 'component');
    @endphp
    <div class="hidden md:fixed md:inset-y-30 md:flex md:w-64 md:flex-col">
        <div class="flex min-h-0 flex-1 flex-col bg-indigo-700">
            <div class="flex flex-1 flex-col overflow-y-auto pb-4">
                <nav class="mt-5 flex-1 space-y-1 px-2">
                    @foreach($tabs as $config)
                        @php
                            $name = \Illuminate\Support\Arr::get($config, 'name');
                            $access = \Illuminate\Support\Arr::get($config, 'access');
                            $label = \Illuminate\Support\Arr::get($config, 'label');
                            $svg = \Illuminate\Support\Arr::get($config, 'svg');
                        @endphp
                        @if ($access)
                            <a wire:click="changeTab('{{$name}}')"
                               @class(['bg-indigo-800 cursor-default text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md'=> $name === $tab,'text-white cursor-pointer hover:bg-indigo-600 hover:bg-opacity-75 group flex items-center px-2 py-2 text-sm font-medium rounded-md'=> $name !== $tab])
                            >
                                {!! $svg !!} {{$label}}
                                @if($label === 'Notifications' && $countNotif !== 0)
                                    <span class="bg-indigo-500 ml-5 inline-block py-0.5 px-3 text-xs font-medium rounded-full">{{$countNotif}}</span>
                                @endif
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
    <div class="flex flex-1 flex-col md:pl-64">
        <div class="sticky top-0 z-10 bg-gray-100 pl-1 pt-1 sm:pl-3 sm:pt-3 md:hidden">
            <button type="button"
                    class="-ml-0.5 -mt-0.5 inline-flex h-12 w-12 items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open sidebar</span>
                <!-- Heroicon name: outline/bars-3 -->
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>
        </div>
        <main class="flex-1">
            <div class="py-6">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                    @php
                        $config = \Illuminate\Support\Arr::first($tabs, fn($value) => \Illuminate\Support\Arr::get($value, 'name') === $tab);
                        $component = \Illuminate\Support\Arr::get($config, 'component');
                        $name = \Illuminate\Support\Arr::get($config, 'name');
                        $access = \Illuminate\Support\Arr::get($config, 'access');
                    @endphp
                    @if($access)
                        <livewire:is :component="$component" :wire:key="$component" :id="$user->id"/>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
