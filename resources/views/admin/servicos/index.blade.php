@extends('layouts.admin')

{{-- @section('title', 'Início') --}}
@section('content')
    <div class='card'>
        <!-- Card header -->
        <div class='card-header'>
            <h3 class='mb-0'>{{isset($titulo)?$titulo: 'Posts'}}</h3>
        </div>
        <!-- Card body -->
        <div class='card-body'>
            <div class='row'>
                <div class='col-12 table'>
                    <table class='table table-striped table-bordered' id='posts-table'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Titulo</th>
                                <th>Slug</th>
                                <th>Publicado</th>
                                <th>Destaque</th>
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
        $('#name').on('input', function () {
            var titulo = $(this).val();
            var slug = gerarSlug(titulo);
            $('#slug').val(slug);
        });
        $('#posts-table').DataTable({
            serverSide: true,
            processing: true,
            "lengthChange": false,
                ajax: '{{ $currentRouteName == 'admin.posts'? route("admin.posts.data_table") :route("admin.$tipo_pagina.data_table") }}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'title'
                },
                {
                    data: 'slug'
                },
                                {
                    class: 'dt-center',
                    render: function (data, type, row) {
                        let badge ="<span class='badge rounded-pill bg-";
                        return row.status == 1 ? badge + "success'>Sim</span>" : badge + "danger'>Não</span>";
                    }
                },
                {
                    class: 'dt-center',
                    render: function (data, type, row) {
                        let badge ="<span class='badge rounded-pill bg-";
                        return row.highlighted == 1 ? badge + "success'>Sim</span>" : badge + "danger'>Não</span>";
                    }
                },
                {
                    class: 'dt-right',
                    render: function (data, type, row) {
                        let buttons =
                            '<a class="btn btn-sm btn-primary pl-2 pr-2" href="{{ route("admin.posts.edit") }}/' +
                            row.id + '"><i class="fa fa-pencil"></i></a>';
                        buttons = buttons +
                            '<a class="btn btn-sm btn-danger pl-2 pr-2" href="{{ route("admin.posts.delete") }}/' +
                            row.id + '"><i class="fa fa-trash"></i></a>';
                        return buttons;
                    }
                }
            ]
        });
    });

</script>

@endsection
