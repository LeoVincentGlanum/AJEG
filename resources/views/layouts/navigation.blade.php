@php
    $type = null;
    if (str_contains(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri(),"chess")){
        $type = "chess";

    }else if (str_contains(\Illuminate\Support\Facades\Route::getFacadeRoot()->current()->uri(),"darts")){
        $type = "darts";
    }
@endphp

<div>
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
            type="button"
            class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar"
           class="fixed top-0 left-0 h-screen transition-transform -translate-x-full 2xl:translate-x-0"
           aria-label="Sidebar">
        <nav class="h-full px-3 py-4 overflow-y-auto bg-custom-white">
            <ul role="list" class="flex flex-col h-full justify-between">
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

                    <ul role="list" class="mt-[86px] space-y-[18px]">
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
                                :href="route('chess.game.dashboard')"
                                :active="request()->routeIs($type === 'chess' ? 'chess.game.dashboard' : 'darts.dashboard')"
                                x-init="
                                        tippy('#games-link', {
                                            content: 'Games',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                id="games-link"
                            >
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path
                                        d="M96 48L82.7 61.3C70.7 73.3 64 89.5 64 106.5V238.9c0 10.7 5.3 20.7 14.2 26.6l10.6 7c14.3 9.6 32.7 10.7 48.1 3l3.2-1.6c2.6-1.3 5-2.8 7.3-4.5l49.4-37c6.6-5 15.7-5 22.3 0c10.2 7.7 9.9 23.1-.7 30.3L90.4 350C73.9 361.3 64 380 64 400H384l28.9-159c2.1-11.3 3.1-22.8 3.1-34.3V192C416 86 330 0 224 0H83.8C72.9 0 64 8.9 64 19.8c0 7.5 4.2 14.3 10.9 17.7L96 48zm24 68a20 20 0 1 1 40 0 20 20 0 1 1 -40 0zM22.6 473.4c-4.2 4.2-6.6 10-6.6 16C16 501.9 26.1 512 38.6 512H409.4c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16L384 432H64L22.6 473.4z"/>
                                </svg>
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                :href="route('chess.game.ranking')"
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
                                <svg class="w-5 h-5" enable-background="new 0 0 34 34" height="512" viewBox="0 0 34 34"
                                     width="512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="m9.2 33h-7.2c-.5 0-1-.5-1-1v-7.3c0-.6.5-1 1-1h7v8.3c0 .3.1.7.2 1z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path
                                                    d="m23 20v12c0 .5-.5 1-1 1h-10c-.5 0-1-.5-1-1v-12c0-.6.5-1 1-1h10c.5 0 1 .4 1 1z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path
                                                    d="m33 26v6c0 .5-.5 1-1 1h-7.2c.1-.3.2-.7.2-1v-7h7c.5 0 1 .4 1 1z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path
                                                    d="m25.1 8-3.3 3.2.8 4.6c.1.4-.1.8-.4 1s-.8.2-1.1.1l-4.1-2.2-4.1 2.1c-.3.2-.7.2-1-.1-.3-.2-.5-.6-.4-1l.8-4.6-3.4-3.1c-.2-.2-.3-.6-.2-1s.4-.6.8-.7l4.6-.7 2-4.1c.3-.7 1.5-.7 1.8 0l2 4.1 4.6.7c.4.1.7.3.8.7s0 .8-.2 1z"/>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
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
                                <svg class="w-5 h-5" enable-background="new 0 0 512 512" height="512"
                                     viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m497 206.571h-96.4c-8.284 0-15 6.716-15 15v19.429h-18.2v-122.715c0-8.284-6.716-15-15-15h-33.2v-19.428c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15v19.428h-18.2v-53.856c0-8.284-6.716-15-15-15h-33.2v-19.429c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15v68.856c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-19.427h18.2v107.715h-18.2v-19.429c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15v68.856c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-19.428h33.2c8.284 0 15-6.716 15-15v-53.858h18.2v19.43c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-19.43h18.2v245.43h-18.2v-19.429c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15v19.429h-18.2v-53.858c0-8.284-6.716-15-15-15h-33.2v-19.428c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15v68.856c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-19.429h18.2v107.715h-18.2v-19.428c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15v68.857c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-19.429h33.2c8.284 0 15-6.716 15-15v-53.856h18.2v19.429c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-19.429h33.2c8.284 0 15-6.716 15-15v-122.715h18.2v19.429c0 8.284 6.716 15 15 15h96.4c8.284 0 15-6.716 15-15v-68.857c0-8.285-6.716-15.001-15-15.001z"/>
                                </svg>
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
                                <svg class="w-5 h-5" enable-background="new 0 0 512 512" height="512"
                                     viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m280.1 152.633c-8.284 0-15 6.716-15 15v88.367c0 8.284 6.716 15 15 15h72.3c8.284 0 15-6.716 15-15s-6.716-15-15-15h-57.3v-73.367c0-8.284-6.716-15-15-15z"/>
                                        <path
                                            d="m444.079 92.024c-43.802-43.801-102.037-67.924-163.979-67.924s-120.176 24.122-163.976 67.922c-40.248 40.249-63.88 92.678-67.449 148.978h-33.675c-6.067 0-11.537 3.654-13.858 9.26-2.321 5.605-1.038 12.057 3.251 16.347l80.333 80.334c2.813 2.813 6.628 4.394 10.607 4.394 3.978 0 7.793-1.58 10.606-4.394l80.334-80.334c4.29-4.29 5.573-10.741 3.252-16.347-2.322-5.605-7.792-9.26-13.858-9.26h-32.388c7.497-68.862 65.997-122.633 136.821-122.633 36.764 0 71.326 14.316 97.321 40.312 25.996 25.995 40.313 60.558 40.313 97.321 0 75.891-61.742 137.633-137.634 137.633-23.982 0-47.582-6.26-68.221-18.075-.188-.12-.385-.24-.595-.362-7.162-4.135-15.301-6.32-23.538-6.32-16.8 0-32.451 9.03-40.846 23.568-6.296 10.903-7.969 23.606-4.71 35.767 3.156 11.78 10.574 21.687 20.946 28.016.318.219.647.427.987.623 35.107 20.313 75.211 31.05 115.977 31.05 61.943 0 120.178-24.122 163.979-67.922s67.921-102.035 67.921-163.978-24.122-120.178-67.921-163.976z"/>
                                    </g>
                                </svg>
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
                                <svg class="w-5 h-5" enable-background="new 0 0 24 24" height="512" viewBox="0 0 24 24"
                                     width="512" xmlns="http://www.w3.org/2000/svg">
                                    <ellipse cx="7" cy="2" rx="7" ry="2"/>
                                    <path
                                        d="m7 8.5c3.866 0 7-.895 7-2v-2.267c-2.204 1.181-5.996 1.267-7 1.267s-4.796-.086-7-1.267v2.267c0 1.105 3.134 2 7 2z"/>
                                    <path
                                        d="m9.5 18.87v2.99c-.77.09-1.62.14-2.5.14-3.87 0-7-.9-7-2v-2.27c2.2 1.18 6 1.27 7 1.27.43 0 1.38-.02 2.5-.13z"/>
                                    <path
                                        d="m9.61 14.36c-.03.09-.05.2-.07.3l-.04-.03v2.73c-.77.09-1.62.14-2.5.14-3.87 0-7-.9-7-2v-2.27c2.2 1.18 6 1.27 7 1.27.44 0 1.44-.02 2.61-.14z"/>
                                    <path
                                        d="m7 10c-1.004 0-4.796-.086-7-1.267v2.267c0 1.105 3.134 2 7 2s7-.895 7-2v-2.267c-2.204 1.181-5.996 1.267-7 1.267z"/>
                                    <ellipse cx="17.5" cy="15" rx="6.5" ry="2"/>
                                    <path
                                        d="m17.5 20.5c3.59 0 6.5-.895 6.5-2v-1.267c-2.046 1.182-5.568 1.267-6.5 1.267s-4.454-.086-6.5-1.267v1.267c0 1.105 2.91 2 6.5 2z"/>
                                    <path
                                        d="m17.5 22c-.932 0-4.454-.086-6.5-1.267v1.267c0 1.105 2.91 2 6.5 2s6.5-.895 6.5-2v-1.267c-2.046 1.181-5.568 1.267-6.5 1.267z"/>
                                </svg>
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link
                                :href="route('darts.online-game')"
                                :active="request()->routeIs($type === 'chess' ? 'chess.dashboard' : 'darts.dashboard')"
                                x-init="
                                        tippy('#onlineGame-link', {
                                            content: 'Partie de fléchettes',
                                            placement: 'right',
                                            theme: 'default',
                                        })
                                    "
                                id="onlineGame-link"
                            >
                                <svg class="w-5 h-5" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M435.662 128.338c-10.866-44.309-45.323-78.766-89.633-89.633l-25.029 61.554c21.901 8.937 37.504 29.453 41.875 53.079l73.787-25.001z"
                                        fill="#dc3e3e"/>
                                    <path
                                        d="M76.338 383.662c10.866 44.309 45.323 78.766 89.633 89.633l25.029-61.554c-21.901-8.937-37.504-29.453-41.875-53.079l-73.787 25.001z"
                                        fill="#f8cc1d"/>
                                    <path
                                        d="M256 32C131.383 32 32 131.383 32 256s99.383 224 224 224 224-99.383 224-224S380.617 32 256 32zm0 410.667c-100.698 0-182.667-81.969-182.667-182.667S155.302 77.333 256 77.333 438.667 159.302 438.667 256 356.698 442.667 256 442.667z"
                                        fill="#ffffff"/>
                                    <circle cx="256" cy="256" r="192" fill="#2b2b2b"/>
                                    <circle cx="256" cy="256" r="160" fill="#ffffff"/>
                                    <circle cx="256" cy="256" r="128" fill="#2b2b2b"/>
                                    <circle cx="256" cy="256" r="64" fill="#ffffff"/>
                                    <circle cx="256" cy="256" r="32" fill="#2b2b2b"/>
                                </svg>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <li class="align-self-end">
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
                                <svg class="w-5 h-5" height="512" viewBox="0 0 48 48" width="512"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g id="Line">
                                        <path
                                            d="m24 2a15 15 0 0 0 -15 15v11.7l-3.32 5a4.08 4.08 0 0 0 3.39 6.3h29.86a4.08 4.08 0 0 0 3.39-6.33l-3.32-4.97v-11.7a15 15 0 0 0 -15-15z"/>
                                        <path d="m24 46a6 6 0 0 0 5.65-4h-11.3a6 6 0 0 0 5.65 4z"/>
                                    </g>
                                </svg>
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
    </aside>
</div>
