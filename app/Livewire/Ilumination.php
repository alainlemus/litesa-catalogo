<?php

namespace App\Livewire;

use App\Models\MediaFile;
use Livewire\Component;

class Ilumination extends Component
{
    public $firstImage = null;
    public $secondImage = null;

    public function mount()
    {
        $this->firstImage = MediaFile::where('name', 'Alumbrado')->first();
        $this->secondImage = MediaFile::where('name', 'Iluminación')->first();
    }

    public function render()
    {
        return view('livewire.ilumination');
    }
}
