<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OSP</title>
    @include('libraries.styles')
</head>

<body>
    @include('components.nav')
    @include('components.flash')
    @yield('content')
    @include('libraries.scripts')
</body>

</html>
