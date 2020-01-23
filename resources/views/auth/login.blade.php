<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sembrar | Ingresar</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
    <div class="login_container">
        <div class="login_container_wrapper">
            <div class="logo_content">
                <img src="img/logo.svg" >
            </div>
            <form class="input_login_wrapper"  method="POST" action="{{ route('access')}}">
                {{ csrf_field() }}
                <div class="input_wrapper icon no_label_icon @error('usuario') require @enderror" >
                    <input type="text" name="usuario" id="usuario" class=" input_user{{$errors->has('usuario' ? 'is-invalid' : '')}}" placeholder="Usuario" autocomplete="off">
                    <i class="material-icons-outlined">person</i>
                    @error('usuario')
                        <div class="message"> Credencial Incorrecto </div>
                    @enderror
                </div>
                <div class="input_wrapper icon no_label_icon @error('password') require @enderror">
                    <input type="password" name="password" id="password" class=" input_pass{{$errors->has('usuario' ? 'is-invalid' : '')}}" placeholder="Contraseña">
                    <i class="material-icons-outlined">lock</i>
                    @error('password')
                        <div class="message"> Credencial Incorrecto </div>
                    @enderror
                </div>
                <button type="submit" name="button" class="button_primary medium"> 
                    <span>
                        INGRESAR
                    </span>
                </button>
            </form>
        </div>
    </div>
</body>
</html>