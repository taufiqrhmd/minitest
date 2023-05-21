<?php

namespace App\Http\Livewire;

use App\Models\Penulis;
use Livewire\Component;

class PenulisTable extends Component
{
    public function render()
    {
        return view('livewire.penulis-table', [
            'penulis' => Penulis::all(),
        ]);
    }
}
