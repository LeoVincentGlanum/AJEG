<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ListTournaments extends Component
{
    use HasToast;

    public array|Collection $tournaments;

    public function mount()
    {
        try {
            $this->tournaments = [];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->tournaments = [];
            $this->errorToast(__('An error occurred while retrieving your tournaments'));
        }
    }

    public function render()
    {
        return view('livewire.dashboard.list-tournaments');
    }
}
