<!DOCTYPE html>
<html>

<head>
    <title inertia>{{ config('app.name') }}</title>

    @vite(['resources/js/app.js'])
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>