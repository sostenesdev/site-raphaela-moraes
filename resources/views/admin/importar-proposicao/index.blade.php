@extends('layouts.admin')

@section('title', 'Cadastrar Categorias')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Importar Proposição</h3>
        </div>
            <form method="post" action="{{route('admin.importar-proposicao.processar')}}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-5">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Arquivo</label>
                        <input class="form-control form-control-lg" type="file" id="file" name="file"
                            placeholder="Selecione o arquivo"  />
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Tipo Proposicao</label>
                        <select class="form-control form-control-lg" type="text" id="slug" name="slug">
                            @foreach($tipos as $tp)
                                <option value="{{$tp->slug}}">{{$tp->nome}}</option>
                            @endforeach
                        </select>
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
