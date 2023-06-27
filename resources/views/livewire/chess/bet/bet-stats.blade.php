<div class="flex">
    <div class="items-center w-full rounded-lg mr-10 pl-3" style="background-color: white">
        <h1 class="text-m font-semibold mt-2 ml-2 mb-3">Total de la saison</h1>
        @if($totalSaison < 0)
            <div class="ml-2 flex mb-[20px]">
                <p class="whitespace-nowrap font-semibold" style="color: #ED3023">
                    {{ $totalSaison }} &nbsp;
                </p>
                <img class="h-6 w-6 rounded-full" src="{{ asset('img/red-coins.svg') }}" alt="red-coin">
            </div>
        @else
            <div class="ml-2 flex mb-[20px]">
                <p class="whitespace-nowrap font-semibold" style="color: #AACB58">
                    {{ $totalSaison }} &nbsp;
                </p>
                <img class="h-6 w-6 rounded-full" src="{{ asset('img/green-coins.svg') }}" alt="green-coin">
            </div>
        @endif
    </div>
</div>

