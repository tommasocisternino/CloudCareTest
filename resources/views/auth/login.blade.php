@extends("layouts/base")
@section('head')
    @parent
@endsection
@section('content')
    <div class="login-page container">
        <form class="login-form col-6 offset-3" action="#" method="GET" id="login-form">
            <label for="username" class="fw-bolder">
                Username
            </label>
            <input type="text" id="username" class="form-input" autocomplete="username" required/>
            <label for="password" class="fw-bolder">
                Password
            </label>
            <input type="password" id="password" class="form-input" autocomplete="password" required/>
            <button id="login-button" class="btn btn-primary" type="submit">LOGIN</button>
        </form>

        <div class="hidden login-status-div col-6 offset-3 mt-5">
            <label class="login-status-label"></label>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="module">
        localStorage.removeItem("user_info");

        const loginStatusDiv = document.querySelector('.login-status-div');
        const loginStatusLabel = document.querySelector('.login-status-label');
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
                    setLoginStatus("login-status-success-div login-status-div", "Login effettuato con successo, stai per essere reindirizzato alla pagina principale");
                    setTimeout(() => {
                        location.href = "/";
                    }, 3000)
                }
            })
                .catch((error) => {
                    setLoginStatus("login-status-error-div login-status-div", "Login fallito, credenziali errate");
                });
        }

        function setLoginStatus(className, text) {
            loginStatusDiv.className = "col-6 offset-3 mt-5 " + className;
            loginStatusLabel.textContent = text;
        }
    </script>
@endsection
