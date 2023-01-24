<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Http\RedirectResponse;

trait HasToast
{
    protected function successToast(string $message)
    {
        $this->dispatchBrowserEvent('toast', [
            'message' => __($message),
            'type' => 'success'
        ]);
    }

    protected function errorToast(string $message)
    {
        $this->dispatchBrowserEvent('toast', [
            'message' => __($message),
            'type' => 'error'
        ]);
    }
}
