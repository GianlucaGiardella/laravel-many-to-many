<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Boolfolio - Project Technology</title>
    @vite('resources/js/app.js')
</head>

<body data-bs-theme="dark" style="background-image: linear-gradient(to right, #8e2de2, #4a00e0);">
    @include('admin.includes.header')
    <main class="container px-5">
        @yield('contents')
    </main>
    @include('admin.includes.footer')
</body>

</html>
