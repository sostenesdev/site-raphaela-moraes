@extends('layouts.admin')

{{-- @section('title', 'Início') --}}
@section('content')
    <div class='card'>
        <!-- Card header -->
        <div class='card-header'>
            <h3 class='mb-0'>Proposições</h3>
        </div>
        <!-- Card body -->
        <div class='card-body'>
            <div class='row'>
                <div class='col-12 table'>
                    <table class='table table-striped table-bordered' id='posts-table'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Título</th>
                                <th>Protocolo</th>
                                <th>Processo</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
    </div>
@endsection


@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/funcoes.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#posts-table').DataTable({
            serverSide: true,
            processing: true,
            "lengthChange": false,
            ajax: '{{ route("admin.proposicao.data_table") }}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'titulo'
                },
                {
                    data: 'protocolo'
                },
                {
                    data: 'processo'
                },
                {
                    data: 'data'
                },
                {
                    data: 'tipo'
                },
                {
                    class: 'dt-center',
                    render: function (data, type, row) {
                        let buttons =
                            '<div class= "text-center"><a class="btn btn-sm btn-primary pl-2 pr-3" href="{{ route("admin.proposicao.edit") }}/' +
                            row.id + '"><i class="fa fa-pencil"></i></a>';
                        buttons = buttons +
                            '<a class="btn btn-sm btn-danger pl-2 pr-3" href="{{ route("admin.proposicao.delete") }}/' +
                            row.id + '"><i class="fa fa-trash"></i></a></div>';
                        return buttons;
                    }
                }
            ]
        });
    });

</script>

@endsection
