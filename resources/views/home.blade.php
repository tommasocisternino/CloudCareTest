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
    <script src="{{ asset("/js/services/beers.js") }}"></script>
    <script type="module">
        document.getElementById('access_token_p').textContent = USER_INFO.access_token;
        let table = new DataTable('#data', {
            ajax: {
                url: "{{ route("get-beers-list") }}",
                dataSrc: 'data',
                lengthChange: true,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + USER_INFO.access_token);
                }
            },
            pagination: true,
            processing: true,
            serverSide: true,
            searching:false,
            "lengthMenu": [10, 25, 50, 75],
            columns: [
                {data: 'name',orderable: false },
                {data: 'tagline',orderable: false },
                {data: 'first_brewed',orderable: false },
            ]
        });
    </script>
@endsection
