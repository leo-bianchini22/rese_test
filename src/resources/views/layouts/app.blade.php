<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rese</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header_inner">
            <div class="header_inner_left">
                <a class=" header_nav" href="/nav"></a>
                <h1 class="header_logo">Rese</h1>
            </div>
            @yield('search')
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @yield('js')
</body>

</html>