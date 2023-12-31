@extends("layouts/base")
@section('head')
    @parent
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.1/datatables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.1/datatables.min.js"></script>
@endsection

@section("content")
    <div class="home-page overflow-hidden">
        <label class="fw-bolder w-100 text-center">Ecco il tuo access_token!</label>
        <button id="debug-button" class="btn btn-primary mx-auto">ANALIZZA</button>
        <div class="fw-bolder mb-5 token-div"><p id="access_token_p"></p></div>

        <table id="data" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Nome birra</th>
                <th>Tagline</th>
                <th>Prima produzione</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Nome birra</th>
                <th>Tagline</th>
                <th>Prima produzione</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section("scripts")
    <script type="module">
        let table = new DataTable('#data', {
            ajax: {
                url: "{{ route("get-beers-list") }}",
                dataSrc: 'data',
                lengthChange: true,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + USER_INFO?.access_token ?? null);
                },
                error: function (jqXHR) {
                    if (jqXHR.status === 401) {
                        UtilsService.swalMessage("error", "Sessione scaduta...", "Effettua di nuovo il login")

                    } else {
                        UtilsService.swalMessage("error", "Errore del server...", "Riprova più tardi")
                    }
                }
            },
            pagination: true,
            processing: true,
            serverSide: true,
            searching: false,
            lengthMenu: [10, 25, 50, 75],
            columns: [
                {data: 'name', orderable: false},
                {data: 'tagline', orderable: false},
                {data: 'first_brewed', orderable: false},
            ],
        });

        document.getElementById('access_token_p').textContent = USER_INFO?.access_token;
        document.getElementById('debug-button').addEventListener('click', function () {
            window.open("https://jwt.io/#debugger-io?token=" + USER_INFO?.access_token, "_blank")
        });
    </script>
@endsection
