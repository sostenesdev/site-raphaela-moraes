@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Cadastrar Denúncia</h3>
    </div>
    @if($currentRouteName == 'admin.denuncia.edit')
        <form method="post" action="{{ route('admin.denuncia.update') }}" enctype="multipart/form-data">
    @else
        <form method="post" action="{{ route('admin.denuncia.save') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $model->id }}" />
    <div class="card-body">
        <!-- campo título -->
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="titulo" class="form-label text-bold">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                        value="{{ $model->titulo }}">
                    @error('titulo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="categoria" class="form-label text-bold">Categoria</label>
                    <select class="form-control" id="categoria" name="categoria" placeholder="Categoria">
                        <option value="">Selecione uma Categoria</option>
                        @foreach($categorias as $c)
                            <option value="{{ $c->slug }}" {{ $c->slug == $model->categoria ? 'selected' : '' }}>{{ $c->nome }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- campo conteúdo -->
        <div class="row">
            <div class="form-group mt-1">
                <label for="conteudo" class="form-label text-bold">Conteúdo</label>
                <textarea class="form-control" id="conteudo" name="conteudo" rows="5"
                    placeholder="Descrição da denúncia">{{ $model->conteudo }}</textarea>
                @error('conteudo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- upload de arquivos -->
        <div class="row mt-3">
            <div class="form-group">
                <label for="arquivos" class="form-label text-bold">Anexar Arquivos</label>
                <input type="file" class="form-control" id="arquivos" name="arquivos[]" multiple>
                <small class="text-muted">Selecione um ou mais arquivos para anexar à denúncia.</small>
            </div>
        </div>

        <!-- listar arquivos existentes (no modo edição) -->
        @if($model->id && $model->arquivos && $model->arquivos->count() > 0)
        <div class="row mt-3">
            <div class="form-group">
                <label class="form-label text-bold">Arquivos Anexados</label>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Extensão</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($model->arquivos as $arquivo)
                        <tr>
                            <td>{{ $arquivo->nome }}</td>
                            <td><span class="badge bg-secondary">{{ $arquivo->extensao }}</span></td>
                            <td class="text-center">
                                <input type="checkbox" name="remover_arquivos[]" value="{{ $arquivo->id }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <small class="text-muted">Marque os arquivos que deseja remover.</small>
            </div>
        </div>
        @endif

    </div>
    <div class="card-footer text-end">
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('assets/js/funcoes.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    // Auto-gerar slug não é necessário para denúncias,
    // mas pode adicionar comportamentos JS aqui se precisar.
});
</script>
@endsection
