<nav class="mt-1 flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
    <div class="-mt-px flex w-0 flex-1">
        <button wire:click="previousPage" class="inline-flex items-center border-t-2 border-transparent pt-4 pr-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            <x-heroicon-m-arrow-long-left class="mr-3 w-5 h-5 text-gray-400"/>
            Previous
        </button>
    </div>
    <div class="hidden md:-mt-px md:flex">
        @php
            $lastPage = $pageGames->lastPage();
            $currentPage = $pageGames->currentPage();
        @endphp
            @for($i = 1; $i <= $lastPage; $i++)
                @if($i <= 1)
                <button wire:click="gotoPage({{$i}})" @class(["inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium",
                                                              "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700"  => $currentPage!==$i,
                                                              "border-indigo-500 text-indigo-600" => $currentPage===$i]) {{($currentPage===$i ? 'aria-current="page"' : '')}}>{{$i}}</button>
                    @if($currentPage > 3)
                        <span class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500">...</span>
                    @endif
                @elseif($i >= $currentPage-1 && $i <= $currentPage+1)
                    <button wire:click="gotoPage({{$i}})" @class(["inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium",
                                                          "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700"  => $currentPage!==$i,
                                                          "border-indigo-500 text-indigo-600" => $currentPage===$i]) {{($currentPage===$i ? 'aria-current="page"' : '')}}>{{$i}}</button>
                @endif

                @if($i >= $lastPage && $currentPage <= $lastPage-2)
                    @if($currentPage < $lastPage-2)
                        <span class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500">...</span>
                    @endif
                    <button wire:click="gotoPage({{$i}})" @class(["inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium",
                                                  "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700"  => $currentPage!==$i,
                                                  "border-indigo-500 text-indigo-600" => $currentPage===$i]) {{($currentPage===$i ? 'aria-current="page"' : '')}}>{{$i}}</button>
                @endif
            @endfor
    </div>
    <div class="-mt-px flex w-0 flex-1 justify-end">
        <button wire:click="nextPage" class="inline-flex items-center border-t-2 border-transparent pt-4 pl-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            Next
            <x-heroicon-m-arrow-long-right class="ml-3 w-5 h-5 text-gray-400"/>
        </button>
    </div>
</nav>
