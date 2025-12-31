<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Marketplace Jasa Desain</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Animate CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
body {
    background-color: #f8f9fa;
}

img {
    max-width: 100%;
    height: auto;
}

.card {
    border-radius: 12px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,.15);
}

.navbar-brand {
    font-weight: bold;
    letter-spacing: 1px;
}
</style>
</head>

<body class="animate__animated animate__fadeIn">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
<div class="container">
    <a class="navbar-brand" href="#">🎨 Marketplace Desain</a>

    @auth
    <span class="text-light me-3">
        {{ auth()->user()->name }} ({{ auth()->user()->role }})
    </span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-light btn-sm">Logout</button>
    </form>
    @endauth
</div>
</nav>

<div class="container mt-4 animate__animated animate__fadeInUp">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
