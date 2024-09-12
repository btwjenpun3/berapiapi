<?php

namespace App\Livewire\Table\Hub\Definition;

use App\Livewire\Modal\Hub\Definition\Create;
use App\Livewire\Modal\Hub\Definition\Edit;
use Livewire\Attributes\On;
use App\Models\HubDefinition;
use Livewire\Component;

class Lists extends Component
{
    public $hubId;

    public function mount($id)
    {
        $this->hubId = $id;
    }

    public function create($hubId)
    {
        $this->dispatch('open-create-modal', $hubId)->to(Create::class);
    }

    public function edit($definitionId)
    {
        $this->dispatch('open-edit-modal', $definitionId)->to(Edit::class);
    }

    #[On('refresh-definition-table')]
    public function refresh()
    {
        $this->mount($this->hubId);
    }

    public function render()
    {
        $definitions = HubDefinition::where('hub_id', $this->hubId)->get();

        return view('livewire.table.hub.definition.lists', [
            'definitions' => $definitions,
        ]);
    }
}
