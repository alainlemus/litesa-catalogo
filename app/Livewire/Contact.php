<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use App\Models\MediaFile;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $formImage = null;

    public $name;
    public $email;
    public $message;
    public $emailContactAdmin = null;
    public $recaptcha;

    protected $listeners = ['captchaVerified'];

    public function captchaVerified($token)
    {
        $this->recaptcha = $token;
    }

    public function mount(){
        $this->formImage = MediaFile::where('name', 'Footer')->first();
        $this->emailContactAdmin = SiteSetting::first()->get('contact_email');
    }

    public function sendMessage()
    {
        logger('➡️ sendMessage llamado');

        $this->validate([
            'name' => 'required|string|min:3',
            'email' => ['required', 'regex:/^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]{2,}$/'],
            'message' => 'required|string|min:10',
            'recaptcha' => ['required', function ($attribute, $value, $fail) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $value,
                ]);

                if (! $response->json('success')) {
                    $fail('Por favor verifica que no eres un robot.');
                }
            }],
        ]);

        logger('✅ Validación pasada');

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        logger('💾 Mensaje guardado');

        try {
            Mail::to($this->email)->send(new \App\Mail\ContactNotification(
                name: $this->name,
                email: $this->email,
                messageContent: $this->message
            ));

            // Correo interno al equipo de Litesa
            Mail::to($this->emailContactAdmin)->send(new \App\Mail\AdminContactNotification(
                name: $this->name,
                email: $this->email,
                messageContent: $this->message
            ));

            logger('📧 Correo enviado');
            session()->flash('success', '¡Mensaje enviado con éxito!');


        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrio un error, por favor vuelve a intentarlo más tarde.');
            logger('Error al enviar el correo: ' . $e->getMessage());
        }

        $this->reset(['name', 'email', 'message', 'recaptcha']);
        $this->emit('resetRecaptcha');
    }


    public function render()
    {
        return view('livewire.contact');
    }
}
