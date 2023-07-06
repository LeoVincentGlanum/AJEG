<div class="flex justify-center items-center py-12">
    <div class="grid grid-cols-2 gap-20">
        <div>
            <h1 class="text-xl font-semibold">Meilleur partie</h1>
            <div class="flex items-center h-12 w-96 rounded-lg" style="background-color: white">
                <img class="h-9 w-9 rounded-full ml-3" src="{{asset('img_profil/'.$topGame?->user->photo) }}" alt="">
                <p class="ml-3 whitespace-nowrap font-semibold">{{ $topGame?->user->name }}</p>
                <p class="ml-32 mr-1 whitespace-nowrap font-semibold start-right">{{$topGame?->score}} points</p>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold">Pire partie</h1>
            <div class="flex items-center h-12 w-96 rounded-lg" style="background-color: white">
                <img class="h-9 w-9 rounded-full ml-3" src="{{asset('img_profil/'.$worstGame?->user->photo) }}" alt="">
                <p class="ml-3 whitespace-nowrap font-semibold">{{ $worstGame?->user->name }}</p>
                <p class="ml-32 mr-1 whitespace-nowrap font-semibold start-right">{{$worstGame?->score}} points</p>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold mb-4">Meilleure manche</h1>
            <div class="flex items-center h-12 w-96 rounded-lg" style="background-color: white">
                <img class="h-9 w-9 rounded-full ml-3" src="{{asset('img_profil/'.$topRound?->user->photo) }}" alt="">
                <p class="ml-3 whitespace-nowrap font-semibold">{{ $topRound?->user->name }}</p>
                <p class="ml-32 mr-1 whitespace-nowrap font-semibold start-right">{{$topRound?->score}} points</p>
            </div>
        </div>
        <div>
            <h1 class="text-xl font-semibold mb-4">Pire manche</h1>
            <div class="flex items-center h-12 w-96 rounded-lg" style="background-color: white">
                <img class="h-9 w-9 rounded-full ml-3" src="{{asset('img_profil/'.$worstRound?->user->photo) }}" alt="">
                <p class="ml-3 whitespace-nowrap font-semibold">{{ $worstRound?->user->name }}</p>
                <p class="ml-32 mr-1 whitespace-nowrap font-semibold start-right">{{$worstRound?->score}} points</p>
            </div>
        </div>
    </div>
</div>
