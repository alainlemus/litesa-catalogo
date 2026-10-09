<?php

namespace App\Livewire;

use App\Models\AboutPageSetting;
use Livewire\Component;

class About extends Component
{
    public function render()
    {
        return view('livewire.about', ['page' => AboutPageSetting::first()]);
    }
}
