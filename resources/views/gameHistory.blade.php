<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historique des parties') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <livewire:games-history-datatables
                        language="fr"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
