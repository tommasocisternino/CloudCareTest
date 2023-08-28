<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ env("APP_NAME") }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset("css/app.css") }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="{{ asset("js/services/axios.js") }}"></script>
    <script src="{{ asset("js/services/auth.js") }}"></script>
    @yield("head")
</head>
<body>
<nav class="w-100 flex text-end bg-info py-3">
    @auth()
        <div>
            <button onclick="logout()" class="btn btn-danger">LOGOUT</button>
            <label class="mx-3 fw-bold">Ciao {{ auth()->user()->username }}!</label>
        </div>

    @endauth
    @guest()
        <label class="mx-3 fw-bold">Effettua il login</label>
    @endguest
</nav>
@auth()
    <div class="hidden logout-status-div col-6 offset-3 mt-5">
        <label class="logout-status-label"></label>
    </div>
@endauth
@yield("content")
</body>

<script>
    const CSRF_TOKEN = "{{ csrf_token() }}";
    const USER_INFO = JSON.parse(localStorage.getItem('user_info'));

    const logoutStatusDiv = document.querySelector('.logout-status-div');
    const logoutStatusLabel = document.querySelector('.logout-status-label');

    function logout() {
        AuthService.logout().then((response) => {
                setLogoutStatus("logout-status-success-div logout-status-div", "Logout effettuato correttamente, stai per essere reindirizzato alla pagina di login");
                setTimeout(() => {
                    location.href = "/login";
                }, 3000)
            }
        ).catch((e) => {
            setLogoutStatus("logout-status-error-div logout-status-div", "Logout già eseguito");
            setTimeout(() => {
                location.href = "/login";
            }, 3000)
        })
    }


    function setLogoutStatus(className, text) {
        logoutStatusDiv.className = "col-6 offset-3 mt-5 " + className;
        logoutStatusLabel.textContent = text;
    }
</script>
@yield("scripts")
</html>
