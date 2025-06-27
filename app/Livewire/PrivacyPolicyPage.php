<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class PrivacyPolicyPage extends Component
{
    public function render()
    {
        $settings = SiteSetting::first();

        return view('livewire.privacy-policy-page', [
            'privacyPolicy' => $settings?->privacy_policy,
        ]);
    }
}
