@extends('layouts.site_v2.master')

@section('title', 'Denúncias')

@section('header_content')
<!-- Start Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Denúncias</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">
                    <li><a href="{{ route('home') }}">Início</a></li>
                    <li>Denúncias</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
@endsection

@section('content')
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <div class="contact-form-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title align-left">
                                <span class="wow fadeInDown" data-wow-delay=".2s">Participe</span>
                                <h2 class="wow fadeInUp" data-wow-delay=".4s">Envie sua Denúncia</h2>
                                <p class="wow fadeInUp" data-wow-delay=".6s">Preencha o formulário abaixo para nos enviar uma denúncia. Opcionalmente, você pode anexar arquivos.</p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="contact-form" method="post" action="{{ route('site.denuncias.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="titulo" class="form-label text-bold">Título <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ex: Buraco na via..." value="{{ old('titulo') }}" required>
                                    @error('titulo')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categoria" class="form-label text-bold">Categoria <span class="text-danger">*</span></label>
                                    <select class="form-control form-select" id="categoria" name="categoria" required>
                                        <option value="">Selecione uma Categoria</option>
                                        @foreach($categorias as $c)
                                            <option value="{{ $c->slug }}" {{ old('categoria') == $c->slug ? 'selected' : '' }}>{{ $c->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoria')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="conteudo" class="form-label text-bold">Conteúdo <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="conteudo" name="conteudo" rows="6" placeholder="Descreva os detalhes da denúncia..." required>{{ old('conteudo') }}</textarea>
                                    @error('conteudo')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="arquivos" class="form-label text-bold">Anexar Arquivos (Opcional)</label>
                                    <input type="file" class="form-control" id="arquivos" name="arquivos[]" multiple>
                                    <small class="text-muted">Selecione um ou mais arquivos (imagens, documentos) para anexar à denúncia.</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="captcha" class="form-label text-bold">Verificação <span class="text-danger">*</span></label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3" style="margin-right: 15px;">
                                            {!! captcha_img('flat') !!}
                                        </div>
                                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Digite o código da imagem" required>
                                    </div>
                                    @error('captcha')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <div class="button">
                                    <button type="submit" class="btn btn-primary">Enviar Denúncia</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
