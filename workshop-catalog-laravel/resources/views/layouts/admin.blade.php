<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Workshop Catalog - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark admin-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('courses.index') }}">
                Workshop Admin
            </a>
            <div class="navbar-nav">
                <a class="nav-link text-white" href="{{ route('courses.index') }}">Corsi</a>
                <a class="nav-link text-white" href="{{ route('categories.index') }}">Categorie</a>
                <a class="nav-link text-white" href="{{ route('levels.index') }}">Livelli</a>
                <a class="nav-link text-white" href="{{ route('teachers.index') }}">Insegnanti</a>
            </div>
            <div class="navbar-nav ms-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mt-4 flex-grow-1">
        @if (session('success'))
            <div id="flash-message" class="alert alert-success alert-dismissible fade show shadow-sm"
                role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 280px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <script>
                setTimeout(() => {
                    const el = document.getElementById('flash-message');
                    if (el) el.remove();
                }, 3000);
            </script>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="border-top bg-white text-muted text-center py-3 mt-4 small">
        Workshop Catalog &mdash; Area Amministrazione
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
