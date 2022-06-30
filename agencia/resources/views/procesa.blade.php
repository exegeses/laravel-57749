<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Proceso de datos desde un fromulario</h1>

    @if( $nombre == 'admin' )
        bienvenido: {{ $nombre }}
    @else
        bienvenido: invitado
    @endif

    <hr>

    Bienvenido {{  ( $nombre == 'admin' )? $nombre : 'invitado' }}

    <hr>
    @forelse ($users as $user)
        <li>{{ $user }}</li>
    @empty
        <p>No users</p>
    @endforelse

</body>
</html>
