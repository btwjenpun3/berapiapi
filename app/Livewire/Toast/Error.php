<?php

namespace App\Livewire\Toast;

use Livewire\Attributes\On;
use Livewire\Component;

class Error extends Component
{
    #[On('toast-error')]
    public function error()
    {
        $this->dispatch('error');
    }

    public function render()
    {
        return view('livewire.toast.error');
    }
}
