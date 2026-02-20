<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Reservas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #1C8C44; color: #fff; }
        h2 { text-align: center; color: #1C8C44; }
    </style>
</head>
<body>
    <h2>Reporte de Reservas - Hotel Naturaleza</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha Entrada</th>
                <th>Fecha Salida</th>
                <th>Habitación</th>
                <th>Personas</th>
                <th>Comentarios</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->nombre }}</td>
                    <td>{{ $reserva->apellido }}</td>
                    <td>{{ $reserva->fecha_entrada }}</td>
                    <td>{{ $reserva->fecha_salida }}</td>
                    <td>{{ $reserva->habitacion }}</td>
                    <td>{{ $reserva->personas }}</td>
                    <td>{{ $reserva->comentarios }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay reservas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>