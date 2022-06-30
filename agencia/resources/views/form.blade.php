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
    <h1>Envío de datos desde form</h1>
    <form action="/procesa" method="post">
        @csrf
        Nombre: <br>
        <input type="text" name="nombre">
        <br>
        <button>enviar</button>
    </form>

</body>
</html>
