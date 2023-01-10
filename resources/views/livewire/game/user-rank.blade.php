<div>
    <ul role="list" class="divide-y divide-gray-200">
        <li class="py-4">
            <div class="flex space-x-3">
                <span style="margin-right: 25px">{{ $rank }}</span>
                <img class="h-9 w-9 rounded-full"
                     src="{{ asset('storage/photos/'.$user->photo) }}"  alt="" onerror="this.onerror=null; this.src='/img/user-default.png'"
                >
                <div class="flex-1 space-y-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium"
                            style="width: 200px">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 mx-80">{{ $user->elo }}</p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $user->elo ?? null }}</p>
                </div>
            </div>
        </li>
    </ul>
</div>
