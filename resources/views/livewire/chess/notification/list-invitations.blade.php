<div class="w-fit">
    <div class="mb-[20px]">
        <span class="text-xl font-semibold">{{ __('Invitation à jouer') }}</span>
    </div>
    @foreach($this->invitations as $invitation)
        <div class="max-w-[500px] p-[20px] bg-custom-card rounded-[10px] align-content-center">
            <p><span class="text-custom-light-text font-semibold">{{ $invitation->game->creator->name }}</span> veut vous affronter</p>

            <div class="mt-[15px] flex justify-between">
                <button
                    wire:click="acceptInvitation({{$invitation->id}})"
                    class="text-sm font-semibold bg-custom-darker-button text-custom-white px-[12px] py-[5px] rounded-[5px]"
                >
                    {{ __('ACCEPTER') }}
                </button>
                <button
                    wire:click="declineInvitation({{$invitation->id}})"
                    class="text-sm font-semibold bg-custom-darker-button text-custom-white px-[12px] py-[5px] rounded-[5px]"
                >
                    {{ __('REFUSER') }}
                </button>
            </div>
        </div>
    @endforeach
</div>
