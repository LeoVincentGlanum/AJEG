<div>
    <form wire:submit.prevent="submit">
        @csrf
         <div class="mb-3">
                <label for="inputName" class="form-label">Nom du tournois</label>
                <input  id="inputName" type="text" wire:model="name" class="form-control">
               @error('name') <span class="error">{{ $message }}</span> @enderror
         </div>

         <div class="mb-3">
                <label for="inputCashPrize" class="form-label">Nom du tournois</label>
                <input  id="inputCashPrize" type="text" wire:model="cashprize_perso" class="form-control">
               @error('name') <span class="error">{{ $message }}</span> @enderror
         </div>
         <div class="mb-3 form-check">
                <input  id="inputNotif" type="checkbox" name="inputNotif" wire:model="notification" class="form-check-input">
               <label class="form-check-label"  for="exampleCheck1">M'avertir quand quelqu'un s'inscrit</label>
         </div>
        <button type="submit" class="btn btn-primary">Creer le tournois</button>
    </form>
</div>
