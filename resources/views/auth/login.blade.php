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
            <input type="password" id="password" class="m-3 mb-5" autocomplete="password" required/>
            <button id="login-button" class="btn btn-primary" type="submit">LOGIN</button>
            <div class="spinner-border text-primary mx-auto" id="spinner" role="status" hidden>
                <span class="visually-hidden">Loading...</span>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="module">
        localStorage.removeItem("user_info");

        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');

        function login() {
            setLoading(true);

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
            }).finally(() => {
                setLoading(false);
            });
        }

        const spinner = document.getElementById('spinner');
        const loginButton = document.getElementById('login-button');
        function setLoading(loading) {
            spinner.hidden = !loading;
            loginButton.hidden = loading;
        }

        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            login();
        });
    </script>
@endsection
