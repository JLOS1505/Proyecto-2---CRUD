<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8" />
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/4e877000d4.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #FFC8DD;"> <!-- Cambia el color de fondo a azul cielo -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="background-color: #BDE0FE;"> <!-- Cambia el color de fondo de la tarjeta a azul cielo -->
                    <b><div class="card-header">{{ __('Inicio de Sesión') }}</div></b>

                    <div class="card-body text-center"> <!-- Centra el contenido -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>                            
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #A2D2FF; border-color: #020202; color: black;"> <!-- Cambia el color del botón a azul cielo -->
                                        {{ __('Iniciar sesión') }}
                                    </button>
                                </div>
                            </div>
                            <div class="container mt-3">
                                <b><a href="{{ route('register') }}">¿No tienes una cuenta? Regístrate aquí</a></b>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
