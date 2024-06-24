<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao StockSync</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Bem-vindo ao StockSync</h1>
            <p class="lead">Uma gestão eficaz e descomplicada.</p>
            <hr class="my-4">
            <p>Para começar, faça login ou registre-se.</p>
            <a class="btn btn-primary btn-lg mr-2" href="{{ route('login') }}" role="button">Login</a>
            <a class="btn btn-secondary btn-lg" href=" {{route('register')}} " role="button">Registrar-se</a>
        </div>
    </div>
</body>
</html>
