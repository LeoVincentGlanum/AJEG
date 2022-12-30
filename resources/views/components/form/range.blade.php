<div>
    <style>
        input[type=range]::-webkit-slider-thumb {
            pointer-events: all;
            width: 24px;
            height: 24px;
            -webkit-appearance: none;
            /* @apply w-6 h-6 appearance-none pointer-events-auto; */
        }
    </style>

    <div
        x-data="range()"
        x-init="minTrigger(); maxTrigger()"
        class="relative max-w-xl w-full">
        <div>
            <input type="range"
                   step="100"
                   x-bind:min="min"
                   x-bind:max="max"
                   x-on:input="minTrigger"
                   x-model="minProperty"
                   wire:model.debounce.500ms="{{ $nameMin }}"
                   class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

            <input type="range"
                   step="100"
                   x-bind:min="min"
                   x-bind:max="max"
                   x-on:input="maxTrigger"
                   x-model="maxProperty"
                   wire:model.debounce.500ms="{{ $nameMax }}"
                   class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

            <div class="relative z-10 h-2">
                <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200"></div>

                <div class="absolute z-20 top-0 bottom-0 rounded-md bg-indigo-500"
                     x-bind:style="'right:'+maxThumb+'%; left:'+minThumb+'%'"></div>

                <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-indigo-500 rounded-full -mt-2 -ml-1"
                     x-bind:style="'left: '+minThumb+'%'"></div>

                <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-indigo-500 rounded-full -mt-2 -mr-3"
                     x-bind:style="'right: '+maxThumb+'%'"></div>
            </div>
        </div>

        <div class="mt-3 flex justify-between items-center">
            <div>
                <input type="text"
                       maxlength="5"
                       x-on:input="minTrigger"
                       x-model="minProperty"
                       wire:model.debounce.500ms="{{ $nameMin }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-center">
            </div>
            <div>
                <input type="text"
                       maxlength="5"
                       x-on:input="maxTrigger"
                       x-model="maxProperty"
                       wire:model.debounce.500ms="{{ $nameMax }}"
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-center">
            </div>
        </div>
    </div>
    <script>
        function range() {
            return {
                minProperty: 0,
                maxProperty: 7000,
                min: 0,
                max: 7000,
                minThumb: 0,
                maxThumb: 0,

                minTrigger() {
                    this.minprice = Math.min(this.minProperty, this.maxProperty - 500);
                    this.minThumb = ((this.minProperty - this.min) / (this.max - this.min)) * 100;
                },

                maxTrigger() {
                    this.maxprice = Math.max(this.maxProperty, this.minProperty + 500);
                    this.maxThumb = 100 - (((this.maxProperty - this.min) / (this.max - this.min)) * 100);
                },
            }
        }
    </script>
</div>
