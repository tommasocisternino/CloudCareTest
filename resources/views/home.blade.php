@extends("layouts/base")
@section('head')
    @parent
@endsection
<div>
    <button id="login-button" type="submit">ASDASDSADASDASDAS</button>
</div>

<script src="{{ asset("/js/services/beers.js") }}"></script>
<script type="module">
    document.getElementById('login-button').addEventListener('click', (e) => {
        check();
    });

    function check() {
        BeerService.check()
            .then((response) => {
                console.log(response)
            })
            .catch((error) => {
                console.log(error)
            });
    }
</script>
