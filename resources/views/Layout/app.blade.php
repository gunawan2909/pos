<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon"
        href="https://scontent.fsrg6-1.fna.fbcdn.net/v/t39.30808-6/309001288_465212065649942_5434593866002232272_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=mNYcOwRYgVYAX8qrdPP&_nc_ht=scontent.fsrg6-1.fna&oh=00_AfBvIVkqyWV-n-Lj-AXAhikaAEFvtzb0h9bRclmy4ec7Qw&oe=6459F503">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.5.x/dist/component.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    @vite('resources/css/app.css')
</head>



<body>
    @yield('content')

</body>

</html>
