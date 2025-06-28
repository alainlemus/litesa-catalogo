<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use App\Models\MediaFile;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $formImage = null;

    public $name;
    public $email;
    public $message;
    public $emailContactAdmin = null;

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

        $this->reset(['name', 'email', 'message']);
    }


    public function render()
    {
        return view('livewire.contact');
    }
}
