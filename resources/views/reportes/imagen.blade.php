<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imagen</title>
</head>
<body>


<img src="{{env('RUTA')}}/public/storage/{{$cliente->documento}}_{{$cliente->id}}/prestamo_{{$prestamo->id}}/imagen/{{$nombre}}.{{$extension}}" alt="" srcset="">
</body>
</html>