<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Usuarios</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #4A90E2; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
<h1>Reporte de Usuarios</h1>
<p>Fecha de exportación: {{ now()->format('d/m/Y') }}</p>

<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Posts</th>
        <th>Comentarios</th>
        <th>Última Conexión</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->posts_count }}</td>
            <td>{{ $user->comments_count }}</td>
            <td>{{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Nunca' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
