<?php

namespace App\Livewire;

use App\Models\MediaFile;
use Livewire\Component;

class Home extends Component
{
    public $cardImage = null;

    public function mount(){
        $this->cardImage = MediaFile::where('name', 'Card')->first();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
