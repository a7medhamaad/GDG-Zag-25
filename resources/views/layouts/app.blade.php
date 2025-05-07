<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Profile Viewer')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/profiles') }}">Profile Viewer</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
