@extends('layouts.admin')

@section('title', 'Cadastrar Categorias')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Categorias de Proposição</h3>
        </div>
        @if($currentRouteName == 'admin.agenda')
            <form method="post" action="{{route('admin.agenda.save')}}">
         @elseif($currentRouteName == 'admin.agenda.edit')
            <form method="post" action="{{ route('admin.agenda.update') }}" enctype="multipart/form-data">
        @endif
            @csrf
            <input type="hidden" name="id" value="{{$model->id}}" />
            <div class="row mb-5">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Título</label>
                        <input class="form-control form-control-lg" type="text" id="title" name="title"
                            placeholder="Digite o title da categoria" value="{{$model->title}}" />
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Cor</label>
                        <input class="form-control form-control-lg" type="color" id="color" name="color" 
                        value="{{$model->color == null? '#df51e1': $model->color }}"
                            placeholder="Digite a cor" />
                            @error('color')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Início</label>
                        <input class="form-control form-control-lg" type="datetime-local" id="start" name="start"
                            placeholder="Digite o title da categoria" value="{{$model->start}}" />
                             @error('start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label class="form-label">Fim</label>
                        <input class="form-control form-control-lg" type="datetime-local" id="end" name="end" value="{{$model->end}}"
                            placeholder="Digite a cor" />
                               @error('end')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                </div>
            </div>
            <div class="row">
            <!-- field slug -->
            <div class="form-group mt-1">
                <label for="descricao"  class="form-label">Link</label>
                <textarea type="text" class="form-control" id="description" name="description" 
                placeholder="Descrição da proposição">{{ $model->description }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
            <div class='footer mt-3'>
            <div class='row mb-3'>
            <div class='col col-md-12 text-end'>
                <a href="{{ route('admin.agenda') }}" class="btn btn-secondary">Voltar</a>
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
            <h3 class="card-title">Agendas</h3>
        </div>
        <div class="col col-12 table">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Início</th>
                        <th>Fim</th>
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
        /* $('#title').on('input', function () {
            var titulo = $(this).val();
            var slug = gerarSlug(titulo);
            $('#slug').val(slug);
        }); */
        $('#myTable').DataTable({
            serverSide: true,
            processing: true,
            "lengthChange": false,
            ajax: '{{route("admin.agenda.data_table")}}',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'title'
                },
                {
                    data: 'start'
                },
                {
                    data: 'end'
                },
                {
                    class: 'dt-right',
                    render: function (data, type, row) {
                        let buttons =
                            '<a class="btn btn-sm btn-primary pl-2 pr-2" href="{{ route("admin.agenda.edit") }}/' +
                            row.id + '"><i class="fa fa-pencil"></i></a>';
                        buttons = buttons +
                            '<a class="btn btn-sm btn-danger  pl-2 pr-2" href="{{ route("admin.agenda.delete") }}/' +
                            row.id + '"><i class="fa fa-trash"></i></a>';
                        return buttons;
                    }
                }
            ]
        });
    });

</script>

@endsection
