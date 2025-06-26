<?php

namespace App\Livewire;

use App\Models\MediaFile;
use Livewire\Component;

class Contact extends Component
{
    public $formImage = null;

    public function mount(){
        $this->formImage = MediaFile::where('name', 'Footer')->first();
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
