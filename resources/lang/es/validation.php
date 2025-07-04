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
        'title' => 'título',
        'slug' => 'slug',
        'category' => 'categoría',
        'excerpt' => 'descripción corta',
        'content' => 'contenido',
        'status' => 'estado',
    ],
    'custom' => [
        'g-recaptcha-response' => [
            'required' => 'Por favor completa el captcha.',
        ],
        'title.required' => 'El título es obligatorio.',
        'slug.unique' => 'Este slug ya está en uso.',
        'category.required' => 'La categoría es obligatoria.',
        'content.required' => 'El contenido no puede estar vacío.',
        'image' => [
            'mimetypes' => 'La imagen debe ser un archivo de tipo: :values.',
        ],
    ],
];
