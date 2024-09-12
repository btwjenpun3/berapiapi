<?php

namespace App\Livewire\Content\Hub\Playground;

use Livewire\Component;

class SideMenu extends Component
{
    public $hub;
    
    public function mount($hub)
    {
        $this->hub = $hub;
    }

    public function render()
    {
        return view('livewire.content.hub.playground.side-menu');
    }
}
