<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - {{ $post->title }}</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #0d0d2b;
            color: #ffffff;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            background: #1c1c3d;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        h1 {
            text-align: center;
            color: #ffcc00;
        }

        .info {
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
            color: #b0b0b0;
        }

        .content {
            text-align: justify;
            line-height: 1.6;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 10px;
            background: #252545;
            border-radius: 10px;
            font-weight: bold;
        }

        .likes, .comments {
            text-align: center;
        }

        .status {
            text-align: center;
            padding: 8px;
            border-radius: 5px;
            font-weight: bold;
            width: fit-content;
            margin: auto;
            margin-top: 10px;
        }

        .public { background-color: #4caf50; color: white; }
        .draft { background-color: #ff9800; color: white; }
        .archived { background-color: #9e9e9e; color: white; }

        .image-container {
            text-align: center;
            margin: 20px 0;
        }

        .image-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $post->title }}</h1>
    <p class="info">Escrito por <strong>{{ $post->user->name }}</strong> el {{ $post->created_at->format('d M Y') }}</p>

    @if($post->image)
        <div class="image-container">
            <img src="{{ public_path('storage/' . $post->image) }}" alt="Imagen del post">
        </div>
    @endif

    <p class="status {{ $post->status }}">
        Estado: {{ ucfirst($post->status) }}
    </p>

    <div class="content">
        <p>{{ $post->content }}</p>
    </div>

    <div class="stats">
        <div class="likes">{{ $post->likes}} Likes</div>
        <div class="comments">{{ $post->comments->count() }} Comentarios</div>
    </div>
</div>

</body>
</html>
