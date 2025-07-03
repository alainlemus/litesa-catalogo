<?php

return [

    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un correo válido.',
    'regex' => 'El campo :attribute tiene un formato inválido.',
    'unique' => 'El campo :attribute ya ha sido registrado.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],

    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'message' => 'mensaje',
    ],
    'custom' => [
        'g-recaptcha-response' => [
            'required' => 'Por favor completa el captcha.',
        ],
    ],
];
