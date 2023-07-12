@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">Informações da Página Inicial</h3>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    @endif

    <form method="post" action="{{ route('admin.pagina_inicial.save') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $model->id }}" />
    <input type="hidden" name="user_id" value="{{auth()->user()->id;}}" />
    <div class="card-body">
        <!-- field title -->
        <div class="row">
            <div class="form-group">
                <label for="title"  class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título"
                    value="{{ $model->titulo }}">
            </div>
        </div>
        <div class="row">
            <!-- field slug -->
            <div class="form-group">
                <label for="slug"  class="form-label">Subtitulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtitulo da página"
                    value="{{ $model->subtitulo }}">
            </div>
        </div>
        @if( isset($model->imagem_principal))
        <div class="row">
            <div class="col col-md-12">
                <a href="{{ route('site.arquivo',['nome' =>$model->imagem_principal]) }}" target="blank">
                        <img id="imagePreview" src="{{ $model->getImage() }}" alt="{{ $model->titulo }}" width="30%"/>
                </a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col col-md-12">
                <img id="imagePreview" src="{{ asset('assets/img/image-not-found.png') }}" alt="{{ $model->title }}" width="30%"/>
            </div>
        </div>
        @endif
        <div class="row">
            <!-- field image -->
            <div class="form-group mb-3">
                <label for="file"  class="form-label">Imagem</label>
                <input type="file" class="form-control" id="file" name="file" placeholder="Imagem"
                    value="{{ old('file') }}">
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3">
                <label for="sobre_previa" class="form-label">Sobre</label>
                <textarea id="tiny" name="sobre_previa">{{ $model->sobre_previa }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3">
                <label for="sobre_previa" class="form-label">Projetos</label>
                <textarea id="tiny" name="texto_projetos">{{ $model->texto_projetos }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3">
                <label for="texto_organograma" class="form-label">Texto organograma</label>
                <textarea id="tiny" name="texto_organograma">{{ $model->texto_organograma }}</textarea>
            </div>
        </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control input-sm"  name="endereco" value="{{ $model->endereco }}" />
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" class="form-control input-sm"  name="email" value="{{ $model->email }}" />
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control input-sm"  name="telefone" value="{{ $model->telefone }}" />
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="text" class="form-control input-sm"  name="twitter" value="{{ $model->twitter }}" >
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="facebook" class="form-label">facebook</label>
            <input type="text" class="form-control input-sm"  name="facebook" value="{{ $model->facebook }}" />
        </div>
    </div>
     <div class="row">
        <div class="form-group mb-3">
            <label for="instagram" class="form-label">instagram</label>
            <input type="text" class="form-control input-sm"  name="instagram" value="{{ $model->instagram }}" />
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="whatsapp" class="form-label">whatsapp</label>
            <input type="text" class="form-control input-sm"  name="whatsapp" value="{{ $model->whatsapp }}" />
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="linkedin" class="form-label">linkedin</label>
            <input type="text" class="form-control input-sm"  name="linkedin" value="{{ $model->linkedin }}" />
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
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function(){
        readURL(this);
    });
    $(document).ready(function () {
        $('#title').on('input', function () {
            var titulo = $(this).val();
            var slug = gerarSlug(titulo);
            $('#slug').val(slug);
        });
    });

</script>
<script>
    tinymce.init({
        selector: 'textarea#tiny',
        plugins: 'lists link image media table code autoresize textpattern',
        toolbar: 'undo redo | formatselect | bold italic strikethrough | link | alignleft aligncenter alignright alignjustify | bullist numlist | blockquote | image | media | table | code',
        content_style: 'body { font-family: Helvetica, Arial, sans-serif; font-size: 16px; }',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        resize: true,
        menubar: true,
        statusbar: false,
        promotion: false,
        content_style: 'body {font-family: "Inter", sans-serif; font-size: 16px; line-height: 1.5;}',
        setup: function (editor) {
            editor.ui.registry.addToggleButton('bold', {
                icon: 'bold',
                tooltip: 'Negrito',
                onAction: function () {
                    editor.execCommand('Bold');
                },
                onSetup: function (buttonApi) {
                    editor.formatter.formatChanged('bold', function (state) {
                        buttonApi.setActive(state);
                    });
                }
            });
            editor.ui.registry.addToggleButton('italic', {
                icon: 'italic',
                tooltip: 'Itálico',
                onAction: function () {
                    editor.execCommand('Italic');
                },
                onSetup: function (buttonApi) {
                    editor.formatter.formatChanged('italic', function (state) {
                        buttonApi.setActive(state);
                    });
                }
            });
            editor.ui.registry.addToggleButton('strikethrough', {
                icon: 'strikethrough',
                tooltip: 'Riscado',
                onAction: function () {
                    editor.execCommand('Strikethrough');
                },
                onSetup: function (buttonApi) {
                    editor.formatter.formatChanged('strikethrough', function (state) {
                        buttonApi.setActive(state);
                    });
                }
            });
        }
    });

    $(document).ready(function () {
        $('#title').on('input', function () {
            var titulo = $(this).val();
            var slug = gerarSlug(titulo);
            $('#slug').val(slug);
        });
        $('.select-categoria').select2();

    });

</script>
@endsection
