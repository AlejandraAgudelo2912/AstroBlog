<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de correo</title>
</head>
<body>
<h1>¡Hola, {{ $user->name }}!</h1>
<p>Aún no has verificado tu correo electrónico. Para completar tu registro, haz clic en el siguiente enlace:</p>
<a href="{{ route('verification.notice') }}">Verificar mi correo</a>
<p>Si ya verificaste tu correo, ignora este mensaje.</p>
</body>
</html>
