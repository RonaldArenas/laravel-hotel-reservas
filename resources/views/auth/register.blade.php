<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Hotel Naturaleza</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap y FontAwesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header, footer {
            background-color: #155d34;
            color: #fff;
            padding: 8px 20px;
        }
        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            background: rgba(255,255,255,.95);
            padding: 25px;
            border-radius: 15px;
            width: 500px;
            box-shadow: 0 6px 18px rgba(0,0,0,.25);
        }
        .btn-primary {
            background-color: #1c8c44;
            border: none;
        }
        .btn-primary:hover {
            background-color: #157a39;
        }
    </style>
</head>

<body>

<header class="d-flex justify-content-between align-items-center">
    <h4 class="m-0">Hotel Naturaleza</h4>
    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Ingresar</a>
</header>

<div class="content">
    <div class="form-container text-center">

        <i class="fa-solid fa-user-plus fa-2x mb-2 text-success"></i>
        <h4>Crear Cuenta</h4>
        <p class="text-muted">Únete a Hotel Naturaleza</p>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            {{-- Documento --}}
            <div class="row mb-3">
                <div class="col-6">
                    <select name="document_type_id" class="form-select @error('document_type_id') is-invalid @enderror">
                        <option value="">Tipo</option>
                        <option value="1" {{ old('document_type_id') == 1 ? 'selected' : '' }}>Cédula</option>
                        <option value="2" {{ old('document_type_id') == 2 ? 'selected' : '' }}>Tarjeta</option>
                        <option value="3" {{ old('document_type_id') == 3 ? 'selected' : '' }}>Pasaporte</option>
                    </select>
                    @error('document_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <input type="text" name="document_number"
                           class="form-control @error('document_number') is-invalid @enderror"
                           placeholder="N° Documento"
                           value="{{ old('document_number') }}">
                    @error('document_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Nombre --}}
            <div class="row mb-3">
                <div class="col-6">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nombre" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"
                           placeholder="Apellido" value="{{ old('lastname') }}">
                    @error('lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Teléfono y Email --}}
            <div class="row mb-3">
                <div class="col-6">
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                           placeholder="Teléfono" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Contraseña">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Confirmar contraseña">
            </div>

            <button class="btn btn-primary w-100">Crear Cuenta</button>

            <div class="mt-3">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}">Inicia sesión</a>
            </div>
        </form>
    </div>
</div>

<footer class="text-center">
    © 2025 Hotel Naturaleza
</footer>

</body>
</html>