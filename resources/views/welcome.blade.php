<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test</title>

    @push('scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    @endpush
</head>

<body>
    <div id="app">
        <Main />
    </div>
</body>

</html>
