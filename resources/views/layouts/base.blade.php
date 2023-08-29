<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ env("APP_NAME") }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset("css/app.css") }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset("js/services/axios.js") }}"></script>
    <script src="{{ asset("js/services/utils.js") }}"></script>
    <script src="{{ asset("js/services/auth.js") }}"></script>
    @yield("head")
</head>
<body>
<nav class="w-100 flex text-end bg-info py-3">
    @auth()
        <button onclick="UtilsService.logout()" class="btn btn-danger">LOGOUT</button>
        <label class="mx-3 fw-bold">Ciao {{ auth()->user()->username }}!</label>
    @endauth
    @guest()
        <label class="mx-3 fw-bold">Effettua il login</label>
    @endguest
</nav>

@yield("content")
</body>

<script>
    const CSRF_TOKEN = "{{ csrf_token() }}";
    let USER_INFO = JSON.parse(localStorage.getItem('user_info'));
</script>
@yield("scripts")
</html>
