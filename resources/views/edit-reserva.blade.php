<x-app-layout>
    <x-slot name="header">
        <header style="background-color: #155d34; color: #fff; padding: 8px 20px; display:flex; justify-content:space-between; align-items:center; border-radius: 10px;">
            <h2>Editar Reserva</h2>
            <nav>
                <a href="{{ route('dashboard') }}" class="text-white me-3">Volver al Dashboard</a>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="btn btn-warning btn-sm">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </header>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="content d-flex justify-content-center">

                <div class="form-container" style="width:480px;">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('reservas.update', $reserva) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <h3 class="text-center text-success mb-3"><i class="fa-solid fa-pen-to-square"></i> Editar Reserva</h3>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nombre" class="form-control" value="{{ $reserva->nombre }}" placeholder="Nombres" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="apellido" class="form-control" value="{{ $reserva->apellido }}" placeholder="Apellidos" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col input-group">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span>
                                <input type="date" name="fecha_entrada" class="form-control" value="{{ $reserva->fecha_entrada }}" required>
                            </div>
                            <div class="col input-group mt-2 mt-md-0">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                <input type="date" name="fecha_salida" class="form-control" value="{{ $reserva->fecha_salida }}" required>
                            </div>
                        </div>

                        <label for="tipoHabitacion">Tipo de habitación:</label>
                        <select id="tipoHabitacion" name="habitacion" class="form-select" onchange="cargarHabitaciones()">
                            <option value="individual" {{ $reserva->habitacion=='individual' ? 'selected' : '' }}>Individual</option>
                            <option value="doble" {{ $reserva->habitacion=='doble' ? 'selected' : '' }}>Doble</option>
                            <option value="suite" {{ $reserva->habitacion=='suite' ? 'selected' : '' }}>Suite</option>
                        </select>

                        <label for="numeroHabitacion" class="mt-2">Número de habitación:</label>
                        <select id="numeroHabitacion" name="habitacion" class="form-select" required>
                            <option value="{{ $reserva->habitacion }}">{{ $reserva->habitacion }}</option>
                        </select>
                        <br>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-user-group"></i></span>
                            <input type="number" name="personas" class="form-control" value="{{ $reserva->personas }}" placeholder="Número de personas" min="1" max="6" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-comment"></i></span>
                            <textarea name="comentarios" class="form-control" rows="2" placeholder="Comentarios">{{ $reserva->comentarios }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar cambios</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function cargarHabitaciones() {
            var tipo = document.getElementById("tipoHabitacion").value;
            var selectNumero = document.getElementById("numeroHabitacion");

            selectNumero.innerHTML = '<option value="">Seleccione habitación</option>';

            if (!tipo) return;

            var habitacionesPorTipo = {
                'individual': ['101','102','103'],
                'doble': ['201','202','203'],
                'suite': ['301','302','303']
            };

            var habitaciones = habitacionesPorTipo[tipo] || [];
            habitaciones.forEach(function(numero){
                selectNumero.innerHTML += `<option value="${numero}">${numero}</option>`;
            });
        }
    </script>

</x-app-layout>