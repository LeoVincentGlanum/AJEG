<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form wire:submit.prevent="submit">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Nom de la partie</label>
                        <input
                            type="email"
                            wire:model="partyName"
                            class="form-control"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                        >
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
                            <input
                                wire:model="players"
                                value="{{$user->id}}"
                                class="form-check-input"
                                type="checkbox"
                                id="flexCheckChecked{{$user->id}}"
                            >
                            <label class="form-check-label" for="flexCheckChecked{{$user->id}}">
                                {{$user->name}}
                            </label>
                        </div>
                    @endforeach

                    @if(count($players) > 1)
                         @if(count($players) == 2)
                             <h3>Couleurs du joueur blanc </h3>
                         @if($selectBlanc === "nul")
                              @if($errors->has('selectBlanc'))
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16">
                                            <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        <div class="ml-2">
                                            <span>{{ $errors->first('selectBlanc') }}</span>
                                        </div>
                                    </div>
                              @endif
                            @endif
                            <select wire:model="selectBlanc">
                                 <option value="nul">Selectionner le joueur blanc ...</option>
                                @foreach($players as $player)
                                    <option value="{{$users->find($player)->id}}">{{$users->find($player)->name}} Blanc </option>
                                @endforeach
                            </select>
                         @else
                            @foreach($players as $player)
                                 <div class="mt-5">
                                    <label for="colorPlayer{{$player}}" class="form-label">Couleur de {{$users->find($player)->name}}</label>
                                    <input wire:model="playersColors.{{$player}}" class="form-control" type="text" id="colorPlayer{{$player}}">
                                 </div>
                            @endforeach
                            @error('playersColors')
                                <div class="mt-6 alert alert-danger d-flex align-items-center" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16">
                                        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <div class="ml-2">
                                        <span>{{ $message }}</span>
                                    </div>
                                </div>
                            @enderror
                         @endif

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
                                <select class="form-control" wire:model="resultat">
                                    <option value="none"></option>
                                    @foreach($players as $player)
                                        <option value="{{$player}}">{{$users->find($player)->name}} Gagnant</option>
                                    @endforeach
                                    <option value="path">Path</option>
                                    <option value="nul">Nul</option>
                                </select>
                            </div>
                        @endif
                    @else
                            <div class="alert alert-danger mt-3" role="alert">
                                <strong>Attention !</strong> Vous devez renseingner aux moins deux joueurs avant de passer à la suite
                            </div>
                    @endif

                    <div class="mt-6 flex items-center">
                        <button type="button" class="btn btn-secondary" wire:click="gotto">Retour</button>
                         @if(count($players) > 1)
                            <button type="submit" class="ml-4 btn btn-success">
                                Creer la partie
                            </button>
                        @endif
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>



