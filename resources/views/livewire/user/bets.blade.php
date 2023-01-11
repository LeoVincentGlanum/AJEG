<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        <thead>
        <tr>
            <th>Date</th>
            <th>Misé sur</th>
            <th>Misé contre</th>
            <th>Somme misé</th>
            <th>Gain</th>
            <th>Statut</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bets as $bet)
            <tr>
                <td class="text-center">{{$bet->created_at }}</td>
                <td class="text-center">{{ $bet->gamePlayers[0]->user->name }}</td>
                <td class="text-center">@if($bet->gamePlayers[0]->user->name == $bet->games[0]->users[1]->name)
                        {{ $bet->games[0]->users[0]->name }}
                    @else
                        {{ $bet->games[0]->users[1]->name }}
                @endif</td>
                <td class="text-center">{{ $bet->bet_deposit }}</td>
                <td class="text-center">
                    @if($bet->bet_status === "Pending") 0
                    @elseif($bet->bet_status === "Win")
                        {{ $bet->bet_gain }}
                    @endif</td>
                <td class="text-center">{{ $bet->bet_status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
