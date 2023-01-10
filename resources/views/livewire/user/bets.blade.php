<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        <thead>
        <tr>
            <th>Date</th>
            <th>Misé sur</th>
            <th>Somme misé</th>
            <th>Gain</th>
            <th>Statut</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bets as $bet)
            <tr>
                <td>{{$bet->created_at }}</td>
                <td>{{ $bet->gamePlayers[0]->user->name }}</td>
                <td>{{ $bet->bet_deposit }}</td>
                <td>
                    @if($bet->bet_status === "Pending") 0
                    @elseif($bet->bet_status === "Win")
                        {{ $bet->bet_gain }}
                    @endif</td>
                <td>{{ $bet->bet_status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
