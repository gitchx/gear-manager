<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Gear Manager</title>
<!--     <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
