<?php

namespace App\Livewire;

use App\Models\AboutPageSetting;
use App\Models\Faq;
use App\Models\ServicesPageSetting;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.services', [
            'page' => AboutPageSetting::first(),
            'settings' => ServicesPageSetting::current(),
            'faqTeaser' => Faq::active()->take(3)->get(),
        ]);
    }
}
