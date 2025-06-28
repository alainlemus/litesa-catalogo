
@php
    $setting = \App\Models\SiteSetting::first();
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto recibido</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:8px;overflow:hidden;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color:#1f2937;padding:20px;">
                            <img src="{{ Storage::disk('public')->url($setting->logo_dark) }}" alt="{{ $setting->name }}" style="height:50px;">
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px 40px;color:#333333;">
                            <h2 style="margin-top:0;color:#1f2937;">Hola {{ $name }},</h2>
                            <p style="margin:15px 0;color:#555;">
                                Hemos recibido tu mensaje y nos pondremos en contacto contigo a la brevedad posible.
                            </p>

                            <p style="margin:15px 0;color:#555;">
                                <strong>Detalles de tu mensaje:</strong><br><br>
                                <strong>Nombre:</strong> {{ $name }}<br>
                                <strong>Email:</strong> {{ $email }}<br>
                                <strong>Mensaje:</strong><br>
                                {{ $messageContent }}
                            </p>

                            <p style="margin-top:30px;color:#555;">
                                Gracias por contactarnos,<br>
                                <strong>Equipo de Grupo Litesa</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9fafb;padding:20px;text-align:center;color:#888;font-size:13px;">
                            Este correo fue enviado a <a href="mailto:{{ $setting->contact_email }}" style="color:#3b82f6;text-decoration:none;">{{ $setting->contact_email }}</a><br>
                            © {{ date('Y') }} Grupo Litesa. Todos los derechos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

