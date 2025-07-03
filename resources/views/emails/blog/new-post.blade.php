<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación Newsletter</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:8px;overflow:hidden;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color:#1f2937;padding:20px;">
                            <img src="{{ asset('img/litesa-logo.png') }}" style="height:50px;">
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:30px 40px;color:#333333;">

                            <p style="margin:15px 0;color:#555;">
                                {{ $post->title }}
                            </p>

                            <p style="margin-top:30px;color:#555;">
                                {{ $post->excerpt }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px 40px;color:#333333;">
                            <a href="{{ route('blog.show', $post->slug) }}">Leer artículo completo</a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f9fafb;padding:20px;text-align:center;color:#888;font-size:13px;">
                            Favor de no contestar estos correos.<br>
                            © {{ date('Y') }} Grupo Litesa. Todos los derechos reservados.
                            <br>
                            Puedes anular tu suscripción: <a href="{{ route('newsletter.unsubscribe', $token) }}">aqui</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>


