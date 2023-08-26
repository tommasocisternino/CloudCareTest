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
</div>

<script>
    document.getElementById('login-form').addEventListener('submit', function (e) {
        e.preventDefault();
        login();
    });

    function login (){
        axios.post('/login', {
            username: document.getElementById('username').value,
            password: document.getElementById('password').value,
        }, {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })
            .then(function (response) {
                // handle success
                console.log(response);
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .finally(function () {
                // always executed
            });
    }
</script>
