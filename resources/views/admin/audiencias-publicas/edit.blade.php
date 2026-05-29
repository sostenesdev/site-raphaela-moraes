@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Cadastrar Audiência Pública</h3>
    </div>
    @if($currentRouteName == 'admin.audiencia-publica.edit')
        <form method="post" action="{{ route('admin.audiencia-publica.update') }}" enctype="multipart/form-data">
    @else
        <form method="post" action="{{ route('admin.audiencia-publica.save') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $model->id }}" />
    <div class="card-body">
        <!-- campo título -->
        <div class="row">
            <div class="col col-md-12">
                <div class="form-group">
                    <label for="titulo" class="form-label text-bold">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                        value="{{ $model->titulo }}">
                    @error('titulo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- campo descrição -->
        <div class="row">
            <div class="form-group mt-1">
                <label for="descricao" class="form-label text-bold">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="5"
                    placeholder="Descrição da audiência pública">{{ $model->descricao }}</textarea>
                @error('descricao')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- upload de documento -->
        <div class="row mt-3">
            <div class="form-group">
                <label for="documento" class="form-label text-bold">Documento</label>
                <input type="file" class="form-control" id="documento" name="documento">
                <small class="text-muted">Selecione um documento (PDF, DOC, DOCX, XLS, XLSX, etc.).</small>
            </div>
        </div>

        <!-- documento existente (no modo edição) -->
        @if($model->id && $model->documento_base64)
        <div class="row mt-3">
            <div class="form-group">
                <label class="form-label text-bold">Documento Atual</label>
                <table class="table table-sm table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Extensão</th>
                            <th>Ações</th>
                            <th>Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $model->documento_nome }}</td>
                            <td><span class="badge bg-secondary">{{ $model->documento_extensao }}</span></td>
                            <td class="text-center">
                                <a href="{{ route('admin.audiencia-publica.download_documento', $model->id) }}"
                                   class="btn btn-sm btn-success" title="Baixar">
                                    <i class="fa fa-download"></i> Baixar
                                </a>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="remover_documento" value="1">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <small class="text-muted">Marque para remover o documento atual. Para substituir, basta enviar um novo.</small>
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
    // Comportamentos JS adicionais aqui se necessário
});
</script>
@endsection
