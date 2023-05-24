<?php

namespace App\Http\Livewire;

use App\Models\Artikel;
use Livewire\Component;

class ArtikelTable extends Component
{
    public function render()
    {
        $user = auth()->user();
        // dd($user);
        $artikels = Artikel::where('id_penulis', $user->id_penulis)->get();

        return view('livewire.artikel-table', [
            'artikels' => $artikels,
        ]);
    }
}
