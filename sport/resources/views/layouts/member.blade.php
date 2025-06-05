<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Membre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.30/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('shared.partials.navbar')
    <div class="container-fluid">
        <div class="row">
            @include('shared.partials.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>