<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <div hidden id="countdown">
        <x-nav-link>
            {{ __('Récompense quotidienne') }}
        </x-nav-link>
    </div>

    @if($isDailyRewardAvailable)
        <x-nav-link wire:click="getDailyReward">
            {{ __('Récompense quotidienne') }}
        </x-nav-link>
    @else
        <x-nav-link id="loader">
            <img src="/img/loader.gif" width="75" height="75">
        </x-nav-link>
        @php
            $dateTime = strtotime(Auth::user()->daily_reward);
            $getDateTime = date("F d, Y H:i:s", $dateTime);
        @endphp
        <script type="text/javascript">
            let content = document.getElementById('countdown').innerHTML;
            const countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();

            const x = setInterval(function() {
                const now = new Date().getTime();

                const distance = countDownDate - now;

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('loader').innerHTML = hours + 'h ' + minutes + 'm ' + seconds + 's ';

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById('loader').innerHTML = content;
                }
            }, 1000);
        </script>
    @endif
</div>
