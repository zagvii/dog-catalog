<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>CanineVision - Raças</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f7f4;
            color: #292524;
        }

        header {
            padding: 24px 40px;
            background: white;
            border-bottom: 1px solid #e7e5e4;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 24px;
        }

        .intro {
            margin-bottom: 32px;
        }

        .intro h2 {
            margin-bottom: 8px;
            font-size: 32px;
        }

        .intro p {
            margin: 0;
            color: #78716c;
        }

        .breed-grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fill, minmax(240px, 1fr));
            gap: 24px;
        }

        .breed-card {
            overflow: hidden;
            background: white;
            border: 1px solid #e7e5e4;
            border-radius: 16px;
        }

        .breed-card img {
            display: block;
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .breed-image-placeholder {
            display: flex;
            width: 100%;
            height: 220px;
            align-items: center;
            justify-content: center;
            background: #eeeae5;
            color: #78716c;
        }

        .breed-content {
            padding: 20px;
        }

        .breed-content h3 {
            margin: 0 0 8px;
            font-size: 20px;
        }

        .breed-group {
            margin-bottom: 16px;
            color: #78716c;
            font-size: 14px;
        }

        .breed-info {
            margin: 6px 0;
            font-size: 14px;
        }

        .temperament {
            margin-top: 16px;
            color: #57534e;
            font-size: 13px;
            line-height: 1.5;
        }
    </style>
</head>

<body>

<header>
    <h1>🐾 CanineVision</h1>
</header>

<main>

    <section class="intro">
        <h2>Catálogo de raças</h2>

        <p>
            Conheça diferentes raças e suas características.
        </p>
    </section>

    <section class="breed-grid">

        @foreach ($breeds as $breed)

            <article class="breed-card">

                @if (data_get($breed, 'image.url'))

                    <img
                        src="{{ data_get($breed, 'image.url') }}"
                        alt="{{ $breed['name'] ?? 'Cachorro' }}"
                    >

                @else

                    <div class="breed-image-placeholder">
                        Sem imagem
                    </div>

                @endif

                <div class="breed-content">

                    <h3>
                        {{ $breed['name'] ?? 'Raça desconhecida' }}
                    </h3>

                    @if (!empty($breed['breed_group']))
                        <div class="breed-group">
                            {{ $breed['breed_group'] }}
                        </div>
                    @endif

                    <div class="breed-info">
                        <strong>Peso:</strong>

                        {{ data_get($breed, 'weight.metric', '-') }}
                        kg
                    </div>

                    <div class="breed-info">
                        <strong>Altura:</strong>

                        {{ data_get($breed, 'height.metric', '-') }}
                        cm
                    </div>

                    <div class="breed-info">
                        <strong>Expectativa:</strong>

                        {{ $breed['life_span'] ?? '-' }}
                    </div>

                    @if (!empty($breed['temperament']))
                        <div class="temperament">
                            {{ $breed['temperament'] }}
                        </div>
                    @endif

                </div>

            </article>

        @endforeach

    </section>

</main>

</body>
</html>