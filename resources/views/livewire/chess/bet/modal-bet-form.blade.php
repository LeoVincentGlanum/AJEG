<div class="w-full bg-custom-card p-[20px] rounded-[5px]">
    <div class="flex justify-center">
        <span class="text-2xl font-bold">{{ __('A VOS PARIS !') }}</span>
    </div>
    <div class="flex justify-center mt-[25px]">
        <span class="text-lg font-semibold">{{ __('Combien voulez vous miser ?') }}</span>
    </div>
    <form wire:submit.prevent="save">
        <div class="bg-custom-white p-[20px] rounded-[10px] mt-[25px]">
            <table class="w-full">
                <thead>
                <tr>
                    <th scope="col" class="font-semibold">{{ __('Game') }} #{{ $game->id }}</th>
                    <th scope="col"></th>
                    <th scope="col" class="text-sm text-custom-light-text font-normal">{{ __('Elo') }}</th>
                    <th scope="col" class="text-sm text-custom-light-text font-normal">{{ __('Cote') }}</th>
                    <th scope="col"></th>
                    <th scope="col" class="text-sm text-custom-light-text font-normal">{{ __('Parieurs') }}</th>
                    <th scope="col" class="text-sm text-custom-light-text font-normal">{{ __('Mise') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($game->gamePlayers as $player)
                        <tr>
                            <td>{{ $player->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center"></td>
                            <td>{{ $player->user->elos->first()->elo ?? '-' }}</td>
                            <td>{{ $player->bet_ratio ?? '-' }}</td>
                            <td class="px-4 py-2 text-xs whitespace-nowrap text-center"></td>
                            <td> - </td>
                            <td>
                                <input
                                    wire:model.debounce.500ms="bets.{{$player->id}}"
                                    type="number"
                                    min="0"
                                    step="1"
                                    class="w-20 bg-custom-card p-[5px] rounded-[5px] border-none focus:ring-0 focus:ring-offset-0">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-[25px]">
            <button
                type="submit"
                class="w-full self-center text-lg font-semibold bg-custom-button p-[12px] rounded-[5px]"
            >
                {{ __('Valider') }}
            </button>
        </div>
    </form>
</div>
