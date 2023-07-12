@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Cadastrar Proposições</h3>
    </div>
    @if($currentRouteName == 'admin.proposicao.edit')
        <!-- multipart formdata -->
        <form method="post" action="{{ route('admin.proposicao.update') }}" enctype="multipart/form-data">
            @else
                <form method="post" action="{{ route('admin.proposicao.save') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $model->id }}" />
    <input type="hidden" name="user_id" value="{{auth()->user()->id;}}" />
    <div class="card-body">
        <!-- field title -->
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="titulo"  class="form-label text-bold">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo"
                        value="{{ $model->titulo }}">
                         @error('titulo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
                       <div class="col col-md-6">
                <div class="form-group">
                    <label for="slug"  class="form-label text-bold">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                        value="{{ $model->slug }}">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="protocolo"  class="form-label text-bold">Protocolo</label>
                    <input type="text" class="form-control" id="protocolo" name="protocolo" placeholder="Titulo"
                        value="{{ $model->protocolo }}">
                        @error('protocolo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
                       <div class="col col-md-6">
                <div class="form-group">
                    <label for="processo"  class="form-label text-bold">Processo</label>
                    <input type="text" class="form-control" id="processo" name="processo" placeholder="processo"
                        value="{{ $model->processo }}">
                        @error('processo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="data"  class="form-label text-bold">Data</label>
                    <input type="date" class="form-control" id="data" name="data" placeholder="Data"
                        value="{{ \Carbon\Carbon::parse($model->data)->format('d/m/Y') }}">
                        @error('data')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
                       <div class="col col-md-6">
                <div class="form-group">
                    <label for="situacao"  class="form-label text-bold">situacao</label>
                    <input type="text" class="form-control" id="situacao" name="situacao" placeholder="situacao"
                        value="{{ $model->situacao }}">
                        @error('situacao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="tipo"  class="form-label text-bold">Tipo</label>
                    <select class="form-control" id="tipo" name="tipo" placeholder="Tipo">
                        <option value="">Selecione um tipo</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->slug }}" {{ $tipo->slug == $model->tipo ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                        @endforeach
                    </select>
                    @error('tipo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <!-- field slug -->
            <div class="form-group mt-1">
                <label for="descricao"  class="form-label">Descrição</label>
                <textarea type="text" class="form-control" id="descricao" name="descricao" 
                placeholder="Descrição da proposição">{{ $model->descricao }}</textarea>
                @error('descricao')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
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
        $('#titulo').on('input', function () {
            var titulo = $(this).val();
            var slug = gerarSlug(titulo);
            $('#slug').val(slug);
        });
    });
</script>
@endsection
