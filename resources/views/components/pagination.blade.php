<nav class="mt-1 flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
    <div class="-mt-px flex w-0 flex-1">
        <button wire:click="previousPage" class="inline-flex items-center border-t-2 border-transparent pt-4 pr-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
            <!-- Heroicon name: mini/arrow-long-left -->
            <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z" clip-rule="evenodd" />
            </svg>
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
            <!-- Heroicon name: mini/arrow-long-right -->
            <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</nav>
