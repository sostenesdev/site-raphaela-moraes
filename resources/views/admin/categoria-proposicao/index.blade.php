@extends('layouts.admin')

@section('title', 'Cadastrar Categorias')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Categorias de Proposição</h3>
        </div>
        @if($currentRouteName == 'admin.categoria-proposicao')
            <form method="post" action="{{route('admin.categoria-proposicao.save')}}">
         @elseif($currentRouteName == 'admin.categoria-proposicao.edit')
            <form method="post" action="{{ route('admin.categoria-proposicao.update') }}" enctype="multipart/form-data">
        @endif
            @csrf
            <input type="hidden" name="id" value="{{$category->id}}" />
            <div class="row mb-5">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input class="form-control form-control-lg" type="text" id="nome" name="nome"
                            placeholder="Digite o nome da categoria" value="{{$category->nome}}" />
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Slug</label>
                        <input class="form-control form-control-lg" type="text" id="slug" name="slug" value="{{$category->slug}}"
                            placeholder="Digite o slug" style="pointer-events: none;" />
                    </div>
                </div>
            </div>
            <div class='footer'>
            <div class='row mb-3'>
            <div class='col col-md-12 text-end'>
                <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categorias</h3>
        </div>
        <div class="col col-12 table">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/funcoes.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#nome').on('input', function () {
            var titulo = $(this).val();
            var slug = gerarSlug(titulo);
            $('#slug').val(slug);
        });
        $('#myTable').DataTable({
            serverSide: true,
            processing: true,
            "lengthChange": false,
            ajax: '{{route("admin.categoria-proposicao.data_table")}}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'nome'
                },
                {
                    data: 'slug'
                },
                {
                    class: 'dt-right',
                    render: function (data, type, row) {
                        let buttons =
                            '<a class="btn btn-sm btn-primary pl-2 pr-2" href="{{ route("admin.categoria-proposicao.edit") }}/' +
                            row.id + '"><i class="fa fa-pencil"></i></a>';
                        buttons = buttons +
                            '<a class="btn btn-sm btn-danger  pl-2 pr-2" href="{{ route("admin.categoria-proposicao.delete") }}/' +
                            row.id + '"><i class="fa fa-trash"></i></a>';
                        return buttons;
                    }
                }
            ]
        });
    });

</script>

@endsection
