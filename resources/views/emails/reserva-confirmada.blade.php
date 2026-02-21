<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva Confirmada</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f8; padding:20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; border-radius:8px; padding:20px;">
                    
                    <tr>
                        <td align="center" style="background:#155d34; color:#fff; padding:15px; border-radius:6px;">
                            <h2 style="margin:0;">Hotel Naturaleza 🌿</h2>
                            <p style="margin:5px 0 0;">Reserva Confirmada</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:20px;">
                            <p>Hola <strong>{{ $usuario->name }}</strong>,</p>

                            <p>
                                Tu reserva ha sido registrada exitosamente.  
                                A continuación encontrarás los detalles:
                            </p>

                            <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
                                <tr>
                                    <td><strong>Nombre:</strong></td>
                                    <td>{{ $reserva->nombre }} {{ $reserva->apellido }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de entrada:</strong></td>
                                    <td>{{ $reserva->fecha_entrada }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de salida:</strong></td>
                                    <td>{{ $reserva->fecha_salida }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Habitación:</strong></td>
                                    <td>{{ $reserva->habitacion }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Personas:</strong></td>
                                    <td>{{ $reserva->personas }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Comentarios:</strong></td>
                                    <td>{{ $reserva->comentarios ?? 'Ninguno' }}</td>
                                </tr>
                            </table>

                            <p style="margin-top:20px;">
                                Gracias por confiar en nosotros.  
                                ¡Te esperamos!
                            </p>

                            <p>
                                <strong>Hotel Naturaleza 🌿</strong>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="font-size:12px; color:#777; padding-top:10px;">
                            © {{ date('Y') }} Hotel Naturaleza - Todos los derechos reservados
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>