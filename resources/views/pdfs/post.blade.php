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
            font-family: 'Poppins', sans-serif;
            background-color: #ffe8f3;
            color: #4a4a4a;
            padding: 20px;
        }

        .logo {
            position: absolute;
            top: 10px;
            right: 20px;
            width: 80px;
            height: auto;
            z-index: 1;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            background: #fffaf5;
            box-shadow: 0 0 10px rgba(255, 182, 193, 0.5);
            position: relative;
        }

        h1 {
            text-align: center;
            color: #ff69b4;
            font-size: 26px;
            margin-top: 80px;
        }

        .info {
            font-size: 14px;
            text-align: center;
            margin-bottom: 15px;
            color: #737373;
        }

        .content {
            text-align: justify;
            line-height: 1.6;
            font-size: 14px;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 10px;
            background: #ffe4e1;
            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;
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
            font-size: 14px;
        }

        .public { background-color: #98fb98; color: #008000; }
        .draft { background-color: #ffd700; color: #8b8000; }
        .archived { background-color: #d3d3d3; color: #696969; }

        .image-container {
            text-align: center;
            margin: 20px 0;
        }

        .image-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 192, 203, 0.5);
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>

<img src="{{ public_path('images/logo-dark.png') }}" alt="Logo" class="logo">

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
        <div class="likes"> {{ $post->likes }} Likes</div>
        <div class="comments">{{ is_countable($post->comments) ? $post->comments->count() : 0 }} Comentarios</div>
    </div>

    <p class="footer">Blog Astronómico - Descubre el Universo</p>
</div>

</body>
</html>
