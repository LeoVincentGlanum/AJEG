<main class="max-w-screen-3xl mx-auto pb-10 lg:py-12 lg:px-8">
    <div class="xl:grid xl:grid-cols-12 xl:gap-x-5">
        <aside class="py-6 px-2 sm:px-6 xl:py-0 xl:px-0 xl:col-span-2">
            <nav class="space-y-1">
                <a
                    wire:click="changeTab('bets')"
                    @class([
                        'group rounded-md px-3 py-2 flex items-center text-sm font-medium cursor-pointer',
                        'text-gray-900 hover:text-gray-900 hover:bg-gray-50' => $tab !== 'bets',
                        'bg-gray-50 text-custom-primary hover:bg-white' => $tab === 'bets'
                    ])
                >
                    @php
                        $icon = Arr::toCssClasses([
                            'flex-shrink-0 -ml-1 mr-3 h-6 w-6',
                            'text-gray-400 group-custom-hover:text-gray-500', $tab !== 'bets',
                            'text-custom-primary' => $tab === 'bets'
                        ])
                    @endphp
                    <x-heroicon-o-chart-pie :class="$icon"/>
                    <span class="truncate">
                        {{ __('My bets') }}
                    </span>
                </a>
                <a
                    wire:click="changeTab('dashboard')"
                    @class([
                        'group rounded-md px-3 py-2 flex items-center text-sm font-medium cursor-pointer',
                        'text-gray-900 hover:text-gray-900 hover:bg-gray-50' => $tab !== 'dashboard',
                        'bg-gray-50 text-custom-primary hover:bg-white' => $tab === 'dashboard'
                    ])
                >
                    @php
                        $icon = Arr::toCssClasses([
                            'flex-shrink-0 -ml-1 mr-3 h-6 w-6',
                            'text-gray-400 group-custom-hover:text-gray-500', $tab !== 'dashboard',
                            'text-custom-primary' => $tab === 'dashboard'
                        ])
                    @endphp
                    <x-heroicon-o-chart-pie :class="$icon"/>
                    <span class="truncate">
                        {{ __('Statistics') }}
                    </span>
                </a>

                <a
                    wire:click="changeTab('dashboard-dart')"
                    @class([
                        'group rounded-md px-3 py-2 flex items-center text-sm font-medium cursor-pointer',
                        'text-gray-900 hover:text-gray-900 hover:bg-gray-50' => $tab !== 'dashboard-dart',
                        'bg-gray-50 text-custom-primary hover:bg-white' => $tab === 'dashboard-dart'
                    ])
                >
                    @php
                        $icon = Arr::toCssClasses([
                            'flex-shrink-0 -ml-1 mr-3 h-6 w-6',
                            'text-gray-400 group-custom-hover:text-gray-500', $tab !== 'dashboard-dart',
                            'text-custom-primary' => $tab === 'dashboard-dart'
                        ])
                    @endphp
                    <x-heroicon-o-chart-pie :class="$icon"/>
                    <span class="truncate">
                        {{ __('Statistics Darts') }}
                    </span>
                </a>

                @if($isTabAvailable)
                    <a
                        wire:click="changeTab('detail')"
                        @class([
                            'group rounded-md px-3 py-2 flex items-center text-sm font-medium cursor-pointer',
                            'text-gray-900 hover:text-gray-900 hover:bg-gray-50' => $tab !== 'detail',
                            'bg-gray-50 text-custom-primary hover:bg-white' => $tab === 'detail'
                        ])
                    >
                        @php
                            $icon = Arr::toCssClasses([
                                'flex-shrink-0 -ml-1 mr-3 h-6 w-6',
                                'text-gray-400 group-custom-hover:text-gray-500', $tab !== 'detail',
                                'text-custom-primary' => $tab === 'detail'
                            ])
                        @endphp
                        <x-heroicon-o-user :class="$icon"/>
                        <span class="truncate">
                            {{ __('My details') }}
                        </span>
                    </a>

                    <a
                        wire:click="changeTab('notifications')"
                        @class([
                            'group rounded-md px-3 py-2 flex items-center text-sm font-medium cursor-pointer',
                            'text-gray-900 hover:text-gray-900 hover:bg-gray-50' => $tab !== 'notifications',
                            'bg-gray-50 text-custom-primary hover:bg-white' => $tab === 'notifications'
                        ])
                    >
                        @php
                            $icon = Arr::toCssClasses([
                                'flex-shrink-0 -ml-1 mr-3 h-6 w-6',
                                'text-gray-400 group-custom-hover:text-gray-500', $tab !== 'notifications',
                                'text-custom-primary' => $tab === 'notifications'
                            ])
                        @endphp
                        <x-heroicon-o-bell-alert :class="$icon"/>
                        <span class="truncate">
                            {{ __('Notifications') }} {{ $numberOfNotifications }}
                        </span>
                    </a>
                @endif
            </nav>
        </aside>
        <div class="space-y-6 sm:px-6 xl:px-0 xl:col-span-10">
            @if($tab === 'bets')
                <livewire:user.bets :user="$user"/>
            @elseif($tab === 'dashboard')
                <livewire:user.dashboard :user="$user"/>
            @elseif($tab === 'dashboard-dart')
                <livewire:user.dashboard-dart :user="$user"/>
            @elseif($tab === 'detail')
                <livewire:user.detail :user="$user"/>
            @elseif($tab === 'notifications')
                <livewire:user.notifications :user="$user"/>
            @endif
        </div>
    </div>
</main>
