<?php

namespace App\Livewire;

use App\Models\Suscriber;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsletterForm extends Component
{
    public string $email = '';
    public bool $suscribed = false;

    public function suscribe()
    {
        $this->validate([
            'email' => 'required|email|unique:suscribers,email',
        ]);

        try {

            $token = Str::uuid();

            Suscriber::create([
                'email' => $this->email,
                'unsubscribe_token' => $token,
            ]);

            $this->suscribed = true;

            Mail::to($this->email)->send(new \App\Mail\NewsletterConfirmation(
                email: $this->email,
                unsubscribeToken: $token,
            ));

            logger('📧 Correo de nuevo registro enviado');

            $this->reset('email');

        } catch (\Exception $e) {
            logger('Error al enviar el correo: ' . $e->getMessage());
        }

    }

    public function unsubscribe(string $token)
    {
        $suscriber = Suscriber::where('unsubscribe_token', $token)->first();

        if (!$suscriber) {
            abort(404);
        }

        $suscriber->delete();

        return view('livewire.unsubscribe-success');
    }

    public function render()
    {
        return view('livewire.newsletter-form');
    }
}

