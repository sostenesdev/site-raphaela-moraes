@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Cadastrar Emendas</h3>
    </div>
    @if($currentRouteName == 'admin.emenda.edit')
        <!-- multipart formdata -->
        <form method="post" action="{{ route('admin.emenda.update') }}" enctype="multipart/form-data">
        @else
            <form method="post" action="{{ route('admin.emenda.save') }}"
                enctype="multipart/form-data">
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $model->id }}" />
    <input type="hidden" name="user_id" value="{{ auth()->user()->id; }}" />
    <div class="card-body">
        <!-- field title -->
        <div class="row mt-2">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="titulo" class="form-label text-bold">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo"
                        value="{{ $model->titulo }}">
                    @error('titulo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="slug" class="form-label text-bold">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                        value="{{ $model->slug }}">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-md-12">
                <div class="form-group">
                    <label for="descricao" class="form-label text-bold">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" placeholder="Descricao">{{$model->descricao }}</textarea>
                    @error('descricao')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col col-md-12">
                <div class="form-group">
                    <label for="orgao_destino" class="form-label text-bold">Orgão destino</label>
                    <textarea class="form-control" id="orgao_destino" name="orgao_destino" placeholder="Órgão destino">{{ $model->orgao_destino }}</textarea>
                    @error('orgao_destino')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            </div>
               <div class="row mt-2">
                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="beneficiario" class="form-label text-bold">Objeto</label>
                        <textarea class="form-control" id="objeto" name="objeto" placeholder="Objeto">{{ $model->objeto }}</textarea>
                        @error('objeto')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="beneficiario" class="form-label text-bold">Beneficiário</label>
                        <textarea class="form-control" id="beneficiario" name="beneficiario" placeholder="Beneficiário">{{ $model->beneficiario }}</textarea>
                        @error('beneficiario')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="estagio_processo" class="form-label text-bold">Estágio do Processo</label>
                        <textarea class="form-control" id="estagio_processo" name="estagio_processo"
                            placeholder="Estágio do Processo">{{ $model->estagio_processo }}</textarea>
                        @error('estagio_processo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="numero_processo" class="form-label text-bold">N° Processo</label>
                        <input type="text" class="form-control" id="numero_processo" name="numero_processo" placeholder="numero_processo"
                            value="{{ $model->processo }}">
                        @error('numero_processo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="valor" class="form-label text-bold">Valor</label>
                        <input type="text" class="form-control" id="valor" name="valor" placeholder="valor"
                            value="{{ $model->valor }}">
                        @error('valor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="data_liberacao" class="form-label text-bold">Data da liberação</label>
                        <input type="date" class="form-control" id="data_liberacao" name="data_liberacao" placeholder="Data da liberacao"
                            value="{{ $model->data_liberacao }}">
                        @error('data_liberacao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="ano" class="form-label text-bold">Ano</label>
                        <input type="text" class="form-control" id="ano" name="ano" placeholder="Ano"
                            value="{{ $model->ano }}">
                        @error('data_liberacao')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <!-- field slug -->
                <div class="form-group mt-1">
                    <label for="link" class="form-label">Link</label>
                    <textarea type="text" class="form-control" id="link" name="link"
                        placeholder="Link">{{ $model->link }}</textarea>
                    @error('link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <div class="row mt-2">
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
