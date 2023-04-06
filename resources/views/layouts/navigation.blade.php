@php

    $type = null;

    if (str_contains(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri(),"chess")){
        $type = "chess";

    }else if (str_contains(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri(),"darts")){
        $type = "darts";

    }

@endphp

<div>
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/80"></div>

        <div class="fixed inset-0 flex">
            <div class="relative mr-16 flex w-full max-w-xs flex-1">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col overflow-y-auto bg-custom-white px-[19px] py-[16px]">
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col">
                            <li>
                                <ul role="list" class="space-y-1">
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')">
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="mt-[86px]">
                                <ul role="list" class="mt-2 space-y-[18px]">
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#dashboard-link', {
                                            content: 'Dashboard',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="dashboard-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#games-link', {
                                            content: 'Games',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="games-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#ranks-link', {
                                            content: 'Ranks',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="ranks-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#tournaments-link', {
                                            content: 'Tournaments',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="tournaments-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#history-link', {
                                            content: 'History',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="history-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#bets-link', {
                                            content: 'Bets',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="bets-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="mt-auto">
                                <ul role="list" class="mt-2 space-y-[18px]">
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#notifications-link', {
                                            content: 'Notifications',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="notifications-link"
                                        >
                                            <x-heroicon-m-bell class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                            x-init="
                                        tippy('#points-link', {
                                            content: 'Points',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="points-link"
                                        >
                                            <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                    <li>
                                        <hr class="text-custom-button"/>
                                    </li>
                                    <li>
                                        <x-nav-link
                                            :href="route('user.my-account')"
                                            :active="request()->routeIs('user.my-account')"
                                            x-init="
                                        tippy('#profil-link', {
                                            content: 'Profil',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                            id="profil-link"
                                        >
                                            <x-heroicon-m-user class="w-5 h-5"/>
                                        </x-nav-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:flex-col bg-custom-white">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex grow flex-col overflow-y-auto px-[19px] py-[16px]">
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col">
                    <li>
                        <ul role="list" class="space-y-1">
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')">
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>
                    <li class="mt-[86px]">
                        <ul role="list" class="mt-2 space-y-[18px]">
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#dashboard-link', {
                                            content: 'Dashboard',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="dashboard-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#games-link', {
                                            content: 'Games',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="games-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#ranks-link', {
                                            content: 'Ranks',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="ranks-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#tournaments-link', {
                                            content: 'Tournaments',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="tournaments-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#history-link', {
                                            content: 'History',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="history-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#bets-link', {
                                            content: 'Bets',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="bets-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>
                    <li class="mt-auto">
                        <ul role="list" class="mt-2 space-y-[18px]">
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#notifications-link', {
                                            content: 'Notifications',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="notifications-link"
                                >
                                    <x-heroicon-m-bell class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                    x-init="
                                        tippy('#points-link', {
                                            content: 'Points',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="points-link"
                                >
                                    <x-heroicon-m-exclamation-triangle class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                            <li>
                                <hr class="text-custom-button"/>
                            </li>
                            <li>
                                <x-nav-link
                                    :href="route('user.my-account')"
                                    :active="request()->routeIs('user.my-account')"
                                    x-init="
                                        tippy('#profil-link', {
                                            content: 'Profil',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                    id="profil-link"
                                >
                                    <x-heroicon-m-user class="w-5 h-5"/>
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="sticky top-0 z-40 flex items-center gap-x-6 bg-custom-white px-4 py-4 shadow-sm sm:px-6 lg:hidden">
        <button type="button" class="-m-2.5 p-2.5 text-custom-text lg:hidden">
            <span class="sr-only">Open sidebar</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </button>
    </div>

    <main>
        <div>
            {{ $slot }}
        </div>
    </main>
</div>
