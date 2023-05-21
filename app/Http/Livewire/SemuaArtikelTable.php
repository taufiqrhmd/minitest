<?php

namespace App\Http\Livewire;

use App\Models\Artikel;
use Livewire\Component;

class SemuaArtikelTable extends Component
{
    public function render()
    {
        return view('livewire.semua-artikel-table', [
            'artikels' => Artikel::all(),
        ]);
    }
}
