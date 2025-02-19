<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://happyhaha.github.io/css/dist/style.min.css">
</head>
<body>
@yield('header')
<div class="max-w-2xl mx-auto">
@yield('content')
</div>
<script src="https://happyhaha.github.io/css/dist/flowbite.min.js"></script>
</body>
</html>

