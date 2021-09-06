@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = app()->getLocale(),
        'locales' => config('app.locales')
    ];
@endphp
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app" >

    <main-app></main-app>

</div>
<!-- ./wrapper -->

{{-- Global configuration object --}}
<script>
    window.config = @json($config);
</script>
<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
