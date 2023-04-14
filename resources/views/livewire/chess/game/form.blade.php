<div>
    <div class="bg-custom-white w-[430px] rounded-[10px] p-[20px]">
        <form wire:submit.prevent="save" class="flex flex-col gap-y-[30px]">
            <label>
                <label for="name">
                    <span class="text-lg font-semibold">{{ __('Game name') }}</span>
                </label>
                <input
                    id="name"
                    wire:model.debounce.500ms="name"
                    class="bg-custom-background rounded-[5px] w-full border-none focus:ring-0 focus:ring-offset-0"
                    type="text"
                >
            </label>

            <div>
                <label for="playerOneId">
                    <span class="text-lg font-semibold">{{ __('Player 1') }}</span>
                </label>
                <div class="flex">
                    <span class="rounded-l-[5px] p-[10px] bg-custom-card fill-custom-white">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M96 48L82.7 61.3C70.7 73.3 64 89.5 64 106.5V238.9c0 10.7 5.3 20.7 14.2 26.6l10.6 7c14.3 9.6 32.7 10.7 48.1 3l3.2-1.6c2.6-1.3 5-2.8 7.3-4.5l49.4-37c6.6-5 15.7-5 22.3 0c10.2 7.7 9.9 23.1-.7 30.3L90.4 350C73.9 361.3 64 380 64 400H384l28.9-159c2.1-11.3 3.1-22.8 3.1-34.3V192C416 86 330 0 224 0H83.8C72.9 0 64 8.9 64 19.8c0 7.5 4.2 14.3 10.9 17.7L96 48zm24 68a20 20 0 1 1 40 0 20 20 0 1 1 -40 0zM22.6 473.4c-4.2 4.2-6.6 10-6.6 16C16 501.9 26.1 512 38.6 512H409.4c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16L384 432H64L22.6 473.4z"/>
                        </svg>
                    </span>
                    <select
                        id="playerOneId"
                        wire:model.debounce.500ms="playerOneId"
                        class="bg-custom-background rounded-r-[5px] w-full border-none focus:ring-0 focus:ring-offset-0"
                    >
                        <option value="0"> -- {{ __('Choose a player') }} -- </option>
                        @foreach($this->players as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('playerOneId')
                <p class="text-sm text-red-400" id="ratio-error">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="playerTwoId">
                    <span class="text-lg font-semibold">{{ __('Player 2') }}</span>
                </label>
                <div class="flex">
                    <span class="rounded-l-[5px] p-[10px] bg-custom-card fill-custom-text">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M96 48L82.7 61.3C70.7 73.3 64 89.5 64 106.5V238.9c0 10.7 5.3 20.7 14.2 26.6l10.6 7c14.3 9.6 32.7 10.7 48.1 3l3.2-1.6c2.6-1.3 5-2.8 7.3-4.5l49.4-37c6.6-5 15.7-5 22.3 0c10.2 7.7 9.9 23.1-.7 30.3L90.4 350C73.9 361.3 64 380 64 400H384l28.9-159c2.1-11.3 3.1-22.8 3.1-34.3V192C416 86 330 0 224 0H83.8C72.9 0 64 8.9 64 19.8c0 7.5 4.2 14.3 10.9 17.7L96 48zm24 68a20 20 0 1 1 40 0 20 20 0 1 1 -40 0zM22.6 473.4c-4.2 4.2-6.6 10-6.6 16C16 501.9 26.1 512 38.6 512H409.4c12.5 0 22.6-10.1 22.6-22.6c0-6-2.4-11.8-6.6-16L384 432H64L22.6 473.4z"/>
                        </svg>
                    </span>
                    <select
                        id="playerTwoId"
                        wire:model.debounce.500ms="playerTwoId"
                        class="bg-custom-background rounded-r-[5px] w-full border-none focus:ring-0 focus:ring-offset-0"
                    >
                        <option value="0"> -- {{ __('Choose a player') }} -- </option>
                        @foreach($this->players as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('playerTwoId')
                <p class="text-sm text-red-400" id="ratio-error">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <label for="date">
                    <span class="text-lg font-semibold">{{ __('Date') }}</span>
                </label>
                <div class="flex">
                    <span class="rounded-l-[5px] p-[10px] bg-custom-card fill-custom-text">
                        <x-heroicon-o-calendar-days class="w-6 h-6" />
                    </span>
                    <input
                        id="date"
                        wire:model.debounce.500ms="date"
                        class="bg-custom-background rounded-r-[5px] w-full border-none focus:ring-0 focus:ring-offset-0"
                        type="date"
                    >
                </div>
                @error('date')
                <p class="text-sm text-red-400" id="ratio-error">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div>
                <span class="text-lg font-semibold">{{ __('Ranked game') }}</span>
                <div>
                    <div class="inline-flex rounded-lg">
                        <input wire:model="isRanked" class="hidden" type="radio" value="1" id="yes-ranked"/>
                        <label
                            for="yes-ranked"
                            @class([
                                "font-semibold uppercase px-[12px] py-[6px] rounded-[5px] text-custom-white",
                                "bg-custom-darker-button" => $isRanked === true,
                                "bg-custom-light-text" => $isRanked !== true,
                            ])
                        >
                            {{ __('Yes') }}
                        </label>
                    </div>
                    <div class="inline-flex rounded-lg">
                        <input wire:model="isRanked" class="hidden" type="radio" value="0" id="no-ranked"/>
                        <label
                            for="no-ranked"
                            @class([
                                "font-semibold uppercase px-[12px] py-[6px] rounded-[5px] text-custom-white",
                                "bg-custom-darker-button" => $isRanked === false,
                                "bg-custom-light-text" => $isRanked !== false,
                            ])
                        >
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <span class="text-lg font-semibold">{{ __('Envoyer un pappel') }}</span>
                <div>
                    <div class="inline-flex rounded-lg">
                        <input wire:model="sendReminder" class="hidden" type="radio" value="1" id="yes-reminder"/>
                        <label
                            for="yes-reminder"
                            @class([
                                "font-semibold uppercase px-[12px] py-[6px] rounded-[5px] text-custom-white",
                                "bg-custom-darker-button" => $sendReminder === true,
                                "bg-custom-light-text" => $sendReminder !== true,
                            ])
                        >
                            {{ __('Yes') }}
                        </label>
                    </div>
                    <div class="inline-flex rounded-lg">
                        <input wire:model="sendReminder" class="hidden" type="radio" value="0" id="no-reminder"/>
                        <label
                            for="no-reminder"
                            @class([
                                "font-semibold uppercase px-[12px] py-[6px] rounded-[5px] text-custom-white",
                                "bg-custom-darker-button" => $sendReminder === false,
                                "bg-custom-light-text" => $sendReminder !== false,
                            ])
                        >
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
            </div>

            <div>
                <span class="text-lg font-semibold">{{ __('Bet on') }}</span>
                <div>
                    <div class="inline-flex rounded-lg">
                        <input wire:model="betAvailable" class="hidden" type="radio" value="1" id="yes-bets"/>
                        <label
                            for="yes-bets"
                            @class([
                                "font-semibold uppercase px-[12px] py-[6px] rounded-[5px] text-custom-white",
                                "bg-custom-darker-button" => $betAvailable === true,
                                "bg-custom-light-text" => $betAvailable !== true,
                            ])
                        >
                            {{ __('Yes') }}
                        </label>
                    </div>
                    <div class="inline-flex rounded-lg">
                        <input wire:model="betAvailable" class="hidden" type="radio" value="0" id="no-bets"/>
                        <label
                            for="no-bets"
                            @class([
                                "font-semibold uppercase px-[12px] py-[6px] rounded-[5px] text-custom-white",
                                "bg-custom-darker-button" => $betAvailable === false,
                                "bg-custom-light-text" => $betAvailable !== false,
                            ])
                        >
                            {{ __('No') }}
                        </label>
                    </div>
                </div>
            </div>

            <button
                type="submit"
                class="text-lg font-semibold bg-custom-button px-[26px] py-[10px] rounded-[5px]"
            >
                {{ __('Créer une partie') }}
            </button>
        </form>
    </div>
</div>
