<div class="grid grid-cols-2 gap-80">
    <div>
        <h1 class="text-xl font-semibold mb-4">Meilleur joueur</h1>
        <div class="flex items-center h-12 w-96 rounded-lg" style="background-color: white">
            <span class="inline-block bg-white p-1 rounded-full ml-2">
                <i class="fa-solid fa-trophy fa-2xl" style="color: #eebc42;"></i>
            </span>
            <img class="h-9 w-9 rounded-full ml-3" src="https://zupimages.net/up/22/50/mide.png" alt="">
            <p class="ml-3 whitespace-nowrap font-semibold">{{ $info_best_player->name }}</p>
            <p class="ml-32 mr-1 whitespace-nowrap font-semibold start-right">{{$win_best_player}} victoires</p>
        </div>
    </div>
    <div>
        <h1 class="text-xl font-semibold mb-4">Meilleur parieur</h1>
        <div class="flex items-center h-12 w-96 rounded-lg" style="background-color: white">
            <span class="inline-block bg-white p-1 rounded-full ml-2">
                <i class="fa-solid fa-coins fa-2xl" style="color: #eebc42;"></i>
            </span>
            <img class="h-9 w-9 rounded-full ml-3" src="https://zupimages.net/up/22/50/mide.png" alt="">
            <p class="ml-3 whitespace-nowrap font-semibold">{{ $info_best_bet?->name }}</p>
            <p class="ml-28 mr-1 whitespace-nowrap font-semibold start-right">{{ $info_best_bet?->wins }} paris réussis </p>
        </div>
    </div>
</div>
