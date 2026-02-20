<x-app-layout>
    <x-slot name="header">
        <header style="background-color: #155d34; color: #fff; padding: 8px 20px; display:flex; justify-content:space-between; align-items:center; border-radius: 10px;">
            <h2>Hotel Naturaleza</h2>
            <h2>Bienvenido {{ Auth::user()->name }} 👋</h2>
            <nav>
                <a href="#" class="text-white me-3">Inicio</a>
                <a href="#" class="text-white me-3">Habitaciones</a>
                <a href="#" class="text-white me-3">Servicios</a>
                <a href="#" class="text-white me-3">Contacto</a>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="btn btn-warning btn-sm">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </header>
    </x-slot>

    <!-- CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        body { background: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed; background-size: cover; font-family: 'Segoe UI', sans-serif; }
        .content { display:flex; flex-wrap:wrap; justify-content:space-around; padding:30px; gap:20px; }
        .form-container, .table-container { background: rgba(255,255,255,0.95); padding:25px; border-radius:15px; box-shadow:0 6px 18px rgba(0,0,0,0.25); }
        .form-container { width:480px; }
        .table-container { flex:1; overflow-y:auto; max-height:550px; }
        .btn-primary { background-color:#1c8c44; border:none; }
        .btn-primary:hover { background-color:#157a39; }
        footer { background-color:#155d34; color:#fff; text-align:center; padding:8px; font-size:13px; margin-top:20px; border-radius:10px; }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="content">

                <!-- Formulario de reservas -->
                <div class="form-container">
                    @if(session('reserva_msg'))
                        <div class="alert alert-{{ session('reserva_msg.type') }}">
                            {{ session('reserva_msg.text') }}
                        </div>
                    @endif

                    <form action="{{ route('reservas.store') }}" method="POST">
                        @csrf
                        <h2>Reservar habitación</h2>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nombre" class="form-control" placeholder="Nombres" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="apellido" class="form-control" placeholder="Apellidos" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span>
                                <input type="date" name="fecha_entrada" class="form-control" required>
                            </div>
                            <div class="col input-group mt-2 mt-md-0">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                <input type="date" name="fecha_salida" class="form-control" required>
                            </div>
                        </div>

                        <!-- Tipo de habitación -->
                        <label for="tipoHabitacion">Tipo de habitación:</label>
                        <select id="tipoHabitacion" name="tipoHabitacion" class="form-select" onchange="cargarHabitaciones()">
                            <option value="">Seleccione tipo</option>
                            <option value="1">Individual</option>
                            <option value="2">Doble</option>
                            <option value="3">Suite</option>
                        </select>
                        <!-- Número de habitación -->
                        <label for="numeroHabitacion" class="mt-2">Número de habitación:</label>
                        <select id="numeroHabitacion" name="habitacion" class="form-select" required>
                            <option value="">Seleccione habitación</option>
                        </select>
                        <br>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user-group"></i></span>
                            <input type="number" name="personas" class="form-control" placeholder="Número de personas" min="1" max="6" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-comment"></i></span>
                            <textarea name="comentarios" class="form-control" rows="2" placeholder="Comentarios o solicitudes especiales"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Confirmar Reserva</button>
                    </form>
                </div>

                <!-- Tabla de reservas -->
                <div class="table-container">
                    <h4 class="mb-3 text-center text-success">Reservas recientes</h4>

                    <table class="table table-striped table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha entrada</th>
                                <th>Fecha salida</th>
                                <th>Habitación</th>
                                <th>Personas</th>
                                <th>Comentarios</th>
                                <th>Acciones</th>
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
                                    <td>
                                        <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('reservas.destroy', $reserva) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Está seguro de eliminar esta reserva?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="text-center">No hay reservas aún</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                     <div class="text-center mt-3">
                        <a href="{{ route('export.reservas') }}" class="btn btn-success">
                            <i class="fa-solid fa-file-excel"></i> Exportar a Excel
                        </a>
                    </div>
                    <a href="{{ route('export.reservas.pdf') }}" class="btn btn-danger mt-2" target="_blank">
                        <i class="fa-solid fa-file-pdf"></i> Descargar PDF
                    </a>
                    </div>
                </div>

            </div>

            <footer>
                © 2025 Hotel Naturaleza - Todos los derechos reservados
            </footer>
        </div>
    </div>

    <script>
        function cargarHabitaciones() {
            var tipo = document.getElementById("tipoHabitacion").value;
            var selectNumero = document.getElementById("numeroHabitacion");
        
            // Limpiar opciones
            selectNumero.innerHTML = '<option value="">Seleccione habitación</option>';
        
            if (!tipo) return;
        
            // Habitaciones según tipo
            var habitacionesPorTipo = {
                1: ['101','102','103'], // Individual
                2: ['201','202','203'], // Doble
                3: ['301','302','303']  // Suite
            };
        
            var habitaciones = habitacionesPorTipo[tipo] || [];
        
            habitaciones.forEach(function(numero){
                selectNumero.innerHTML += `<option value="${numero}">${numero}</option>`;
            });
        }
    </script>

</x-app-layout>