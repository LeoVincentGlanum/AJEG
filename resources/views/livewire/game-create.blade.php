<div class="mt-3">
    <h1> Creation de partie</h1>
    <form wire:submit.prevent="submit">

        <div class="mt-5">
            <label for="exampleInputEmail1" class="form-label">Nom de la partie</label>
            <input type="email" wire:model="partyName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mt-5">
            <label for="exampleInputEmail1" class="form-label">Type de partie </label>
            <select class="form-select" aria-label="Default select example">
                @foreach($gameTypes as $gameType)
                    <option value="">{{$gameType->label}}</option>
                @endforeach
            </select>
        </div>

        <h3 class="my-3"> Joueurs </h3>

        @foreach($users as $user)
            <div class="form-check">
                <input wire:model="players" value="{{$user->id}}" class="form-check-input" type="checkbox" id="flexCheckChecked{{$user->id}}">
                <label class="form-check-label" for="flexCheckChecked{{$user->id}}">
                    {{$user->name}}
                </label>
            </div>
        @endforeach

        @if(count($players) > 1)

            <h3 class="my-3"> Status du match </h3>

            <select wire:model="type" class="form-control" name="status">
                <option value="ask">Demande de game</option>
                <option value="current">En cours</option>
                <option value="end">Terminée</option>
            </select>

            @if($type === "end")

                <div class="mt-5">
                    <label for="exampleInputEmail1" class="form-label">Date de la partie</label>
                    <input type="date" class="form-control" id="date">
                </div>

                <div class="mt-5">
                    <label for="exampleInputEmail1" class="form-label">Resultat de la partie</label>
                    <select class="form-control">

                        @foreach($players as $player)
                            <option>{{\App\Models\User::find($player)->name}} Gagnant</option>
                        @endforeach
                        <option>Path</option>
                        <option>Nul</option>
                    </select>

                </div>
            @endif
        <div style="
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            flex-direction: row-reverse;
            ">
            <button type="submit" class="btn btn-success mt-3" style="margin-left: 1vw;">Creer la partie</button>
        @else
            <div class="alert alert-danger mt-3" role="alert">
                <strong>Attention ! </strong> Vous devez renseingner aux moins deux joueurs avant de passer à la suite
            </div>
        @endif


    </form>

    <button class="btn btn-secondary" wire:click="gotto" onclick="return false;">Retour</button>
</div>



