<?php

namespace App\Livewire;

use App\Models\MediaFile;
use Livewire\Component;

class Home extends Component
{
    public $headerImage = null;
    public $cardImage = null;
    public $formImage = null;

    public function mount(){
        $this->headerImage = MediaFile::where('name', 'Header')->first();
        $this->cardImage = MediaFile::where('name', 'Card')->first();
        $this->formImage = MediaFile::where('name', 'Footer')->first();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
