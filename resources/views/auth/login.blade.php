@extends("layouts/base")
<div class="login-page">
    <form class="login-form" action="#" method="GET" id="login-form">
        <label for="name">
            Username
            <input type="text" id="username" class="form-input" autocomplete="username"/>
        </label>
        <label for="password">
            Password
            <input type="password" id="password" class="form-input" autocomplete="password"/>
        </label>
        <button id="login-button" type="submit">LOGIN</button>
    </form>

    <div class="hidden login-status-div">
        <label class="login-status-label"></label>
    </div>
</div>

<script>
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
        axios.post('/login', {
            username: usernameInput.value,
            password: passwordInput.value,
        }, {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })
            .then((response) => {
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
        loginStatusDiv.className = className;
        loginStatusLabel.textContent = text;
    }
</script>
