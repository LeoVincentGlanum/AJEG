<div>
    <h3 class="mt-5">Ajouter une catégorie de Game : </h3>
    <div>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="mb-3">
            <label for="inputLabel" class="form-label">Label de la categorie</label>
            <input id="inputLabel" name="label" type="text" wire:model="label" class="form-control">
            @error('label') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="inputRatio" class="form-label">Ratio de gain (1:1) par defaut </label>
            <input id="inputRatio" step="0.01" name="ratio" type="number" wire:model="ratio" class="form-control">
            @error('ratio') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Creer la categorie</button>
    </form>
</div>
</div>
