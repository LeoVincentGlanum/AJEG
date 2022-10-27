<div>
    <form wire:submit.prevent="submit">
        @csrf
         <div class="mb-3">
                <label for="inputName" class="form-label">Nom du tournois</label>
                <input  id="inputName" name="name" type="text" wire:model="name" class="form-control">
               @error('name') <span class="error">{{ $message }}</span> @enderror
         </div>

         <div class="mb-3">
                <label for="inputCashPrize" class="form-label">Cash Prize Perso</label>
                <input  id="inputCashPrize" name="cashprize_perso" type="text" wire:model="cashprize_perso" class="form-control">
               @error('cashprize_perso') <span class="error">{{ $message }}</span> @enderror
         </div>

         <div class="mb-3">
                <label for="inputCashPrizeModo" class="form-label">Cash Prize Modo</label>
                <input  id="inputCashPrizeModo" name="cashprize_modo" type="text" wire:model="cashprize_modo" class="form-control">
               @error('cashprize_modo') <span class="error">{{ $message }}</span> @enderror
         </div>


         <div class="mb-3 form-check">
                <input  id="inputNotif" type="checkbox" name="inputNotif" wire:model="notification" class="form-check-input">
               <label class="form-check-label"  for="exampleCheck1">M'avertir quand quelqu'un s'inscrit</label>
         </div>
        <button type="submit" class="btn btn-primary">Creer le tournois</button>
    </form>
</div>
