@extends("layouts/base")

@section('content')
    <div class="login-page container">
        <form class="login-form col-6 offset-3" action="#" method="GET" id="login-form">
            <label for="username" class="fw-bolder">
                Username
            </label>
            <input type="text" id="username" class="m-3" autocomplete="username" required/>
            <label for="password" class="fw-bolder">
                Password
            </label>
            <input type="password" id="password" class="m-3" autocomplete="password" required/>
            <button id="login-button" class="btn btn-primary" type="submit">LOGIN</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="module">
        localStorage.removeItem("user_info");

        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');

        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            login();
        });

        function login() {
            let payload = {
                username: usernameInput.value,
                password: passwordInput.value,
            };
            AuthService.login(payload).then((response) => {
                if (response.status === 200) {
                    localStorage.setItem("user_info", JSON.stringify(response.data));
                    UtilsService.swalMessage("success", "Login effettuato...", "Stai per essere reindirizzato alla pagina principale");
                    setTimeout(() => {
                        location.href = "/";
                    }, 3000)
                }
            }).catch((e) => {
                if (e.response.status === 401 || e.response.status === 422) {
                    UtilsService.swalMessage("error", "Login fallito...", "Credenziali errate");
                } else if (e.response.status === 500) {
                    UtilsService.swalMessage("error", "Errore del server...", "Riprova piu tardi");
                } else if (e.response.status === 419) {
                    UtilsService.swalMessage("error", "Sessione scaduta...", "Ricarica la pagina");
                    setTimeout(() => {
                        location.reload();
                    }, 3000)
                }
            });
        }
    </script>
@endsection
