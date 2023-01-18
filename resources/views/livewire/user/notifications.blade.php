<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <ul role="list" class="divide-y divide-gray-200">
        @forelse($notifications as $notification)
            @php
                $creatorNotification = $creatorNotifications[$notification->id]
            @endphp
            <li>
                <a href="{{route('game.show',['game' => $notification->data["game_id"]])}}" class="block hover:bg-gray-50">
                    <div class="flex items-center px-4 py-4 sm:px-6">
                        <div class="flex min-w-0 flex-1 items-center">

                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">

                                <div class="md:block">
                                    <div>
                                        <p class="text-sm text-gray-900">
                                            <time
                                                datetime="{{ $notification->created_at }}">{{ $notification->created_at->format('j F, H:i:s') }}</time>
                                        </p>
                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                            {{$notification->data["message"]}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-heroicon-m-chevron-right class="w-5 h-5 cursor-pointer"/>
                        </div>
                    </div>
                </a>
            </li>
        @empty
            <div class="min-h-full bg-white px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
                <div class="mx-auto max-w-max">
                    <main class="sm:flex">
                        <x-heroicon-s-check-circle class="w-12 h-12 cursor-pointer text-green-600"/>
                        <div class="sm:ml-6">
                            <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                                    Vous n'avez pas de notifications
                                </h1>
                                <p class="mt-1 text-base text-gray-500">Revenez plus tard ...</p>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        @endforelse
    </ul>
</div>
