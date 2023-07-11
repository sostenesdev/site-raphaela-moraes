@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Cadastrar Proposições</h3>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    @endif
    @if($currentRouteName == 'admin.organograma.edit')
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
                    <label for="titulo"  class="form-label text-bold">Cargo</label>
                    <input type="text" class="form-control" id="title" name="titulo" placeholder="Titulo"
                        value="{{ $model->titulo }}">
                </div>
            </div>
                       <div class="col col-md-6">
                <div class="form-group">
                    <label for="slug"  class="form-label text-bold">Slug</label>
                    <input type="text" class="form-control" id="title" name="slug" placeholder="Slug"
                        value="{{ $model->slug }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="protocolo"  class="form-label text-bold">Protocolo</label>
                    <input type="text" class="form-control" id="protocolo" name="protocolo" placeholder="Titulo"
                        value="{{ $model->protocolo }}">
                </div>
            </div>
                       <div class="col col-md-6">
                <div class="form-group">
                    <label for="processo"  class="form-label text-bold">Processo</label>
                    <input type="text" class="form-control" id="title" name="slug" placeholder="processo"
                        value="{{ $model->processo }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="data"  class="form-label text-bold">Data</label>
                    <input type="date" class="form-control" id="data" name="data" placeholder="Data"
                        value="{{ $model->data }}">
                </div>
            </div>
                       <div class="col col-md-6">
                <div class="form-group">
                    <label for="situacao"  class="form-label text-bold">situacao</label>
                    <input type="text" class="form-control" id="situacao" name="situacao" placeholder="situacao"
                        value="{{ $model->situacao }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="tipo"  class="form-label text-bold">Tipo</label>
                    <select class="form-control" id="tipo" name="tipo" placeholder="Tipo">
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->slug }}" {{ $tipo->slug == $model->tipo ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- field slug -->
            <div class="form-group mt-1">
                <label for="descricao"  class="form-label">Descrição</label>
                <textarea type="text" class="form-control" id="descricao" name="descricao" 
                placeholder="Descrição da proposição">{{ $model->descricao }}</textarea>
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
<!-- <script type="text/javascript" src="{{ asset('assets/js/funcoes.js') }}"></script> -->
@endsection
