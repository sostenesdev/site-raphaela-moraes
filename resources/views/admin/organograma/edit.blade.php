@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Cadastrar Cargo</h3>
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
        <form method="post" action="{{ route('admin.organograma.update') }}" enctype="multipart/form-data">
            @else
                <form method="post" action="{{ route('admin.organograma.save') }}" enctype="multipart/form-data">
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $post->id }}" />
    <input type="hidden" name="user_id" value="{{auth()->user()->id;}}" />
    <div class="card-body">
        <!-- field title -->
        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="cargo"  class="form-label text-bold">Cargo</label>
                    <input type="text" class="form-control" id="title" name="cargo" placeholder="Cargo"
                        value="{{ $post->cargo }}">
                </div>
            </div>
            <div class="col col-md-6">
                <!-- field slug -->
                <div class="form-group mt-1">
                    <label for="slug"  class="form-label">Função</label>
                    <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Função"
                        value="{{ $post->funcao }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-6">
                <!-- field slug -->
                <div class="form-group">
                    <label for="slug"  class="form-label">Nome</label>
                    <input type="text" class="form-control" id="pessoa_nome" name="pessoa_nome" placeholder="Nome"
                        value="{{ $post->pessoa_nome }}">
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label for="content" class="form-label">Regime de trabalho</label>
                    <select id="highlighted" class="form-select" name="regime_trabalho">
                        <option value="1" {{ $post->regime_trabalho == 1 ? 'selected' : '' }}>Externo</option>
                        <option value="0" {{ $post->regime_trabalho == 0 ? 'selected' : '' }}>Interno</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- field slug -->
            <div class="form-group mt-1">
                <label for="slug"  class="form-label">Descrição</label>
                <textarea type="text" class="form-control" id="descricao" name="descricao" 
                placeholder="Descrição do cargo">{{ $post->descricao }}</textarea>
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
