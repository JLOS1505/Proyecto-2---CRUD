<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4e877000d4.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #FFC8DD;
        }
        .container {
            /* Eliminamos el margen superior */
        }
        .card {
            background-color: #BDE0FE;
            margin-top: 2rem; /* Agregamos un margen superior de 2rem */
        }
        .card-header {
            font-weight: bold;
        }
        .form-control:focus {
            border-color: #020202;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #A2D2FF;
            border-color: #020202;
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Registro de Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">{{ __('Registrarse') }}</button>
                    </form>
                    <div class="mt-3 text-center">
                        <b><a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión aquí</a></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
