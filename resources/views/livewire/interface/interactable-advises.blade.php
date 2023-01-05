<div >
    <div wire:poll="pollEvent">
        @if($visible)
            <div class=" grid grid-cols-10  overflow-hidden rounded-md border border-gray-300   bg-grey-500">
                <x-heroicon-o-exclamation-triangle class="text-amber-500 self-center col-span-1 ml-5 w-10 "/>
                <span class=" col-span-7 text-center self-center">{{$mainText}}</span>
                @if(isset($buttonText))
                    <a wire:click="setFalseVisibleAdvise" class="col-span-2 inline-flex items-center rounded-md border border-transparent bg-blue-600 m-2 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __($buttonText) }}
                        <x-heroicon-s-arrow-path class=" ml-3 w-6"/>
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
