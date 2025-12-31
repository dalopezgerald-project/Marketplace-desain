<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Marketplace Jasa Desain Grafis</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Mini Design Marketplace</a>
        <div>
            <a href="/login" class="btn btn-outline-light btn-sm">Login</a>
            <a href="/register" class="btn btn-warning btn-sm ms-2">Register</a>
        </div>
    </div>
</nav>

<div class="container mt-5 text-center">
    <h1 class="fw-bold mb-3">Marketplace Jasa Desain Grafis</h1>
    <p class="text-muted mb-4">
        Temukan desainer profesional dan pesan jasa desain dengan mudah.
    </p>

    <a href="/login" class="btn btn-primary btn-lg me-2">Mulai Sekarang</a>
    <a href="/register" class="btn btn-outline-secondary btn-lg">Daftar</a>
</div>

</body>
</html>
