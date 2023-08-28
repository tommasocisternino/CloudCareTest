<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset("css/app.css") }}" rel="stylesheet"/>
    <script src="{{ asset("js/services/axios.js") }}"></script>

    @yield("head")
</head>
<body>
@section("content")
@endsection
</body>

<script>
    const CSRF_TOKEN = "{{ csrf_token() }}";
</script>
</html>
