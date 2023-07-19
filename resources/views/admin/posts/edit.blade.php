@extends('layouts.admin')

@section('title', 'Início')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="mb-0">{{isset($titulo)?$titulo:'Cadastrar Post'}}</h3>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
        </div>
    @endif
    {{--
    <form method="post" id="addPost" action="{{ route('admin.posts.save') }}"> --}}
    @if($currentRouteName == 'admin.posts.edit')
        <!-- multipart formdata -->
        <form method="post" action="{{ route('admin.posts.update') }}" enctype="multipart/form-data">
    @elseif($currentRouteName == 'admin.posts.new')
                <form method="post" action="{{ route('admin.posts.save') }}" enctype="multipart/form-data">

    @elseif($currentRouteName == 'admin.projeto.edit')
        <!-- multipart formdata -->
        <form method="post" action="{{ route('admin.projeto.update') }}" enctype="multipart/form-data">
    @elseif($currentRouteName == 'admin.projeto.new')
        <form method="post" action="{{ route('admin.projeto.save') }}" enctype="multipart/form-data">        
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $post->id }}" />
    <input type="hidden" name="user_id" value="{{auth()->user()->id;}}" />
    <div class="card-body">
        <!-- field title -->
        <div class="row">
            <div class="form-group">
                <label for="title"  class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Título do post"
                    value="{{ $post->title }}">
            </div>
        </div>
        <div class="row">
            <!-- field slug -->
            <div class="form-group">
                <label for="slug"  class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug do post"
                    value="{{ $post->slug }}">
            </div>
        </div>
        <div class="row">
            <!-- field content -->
            <!-- field category -->
            <div class="form-group">
                <label for="category"  class="form-label">Categorias</label><br />

                @foreach($categories as $category)
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" name="categories[]" type="checkbox"
                            value="{{ $category->id }}" id="flexCheckChecked"
                            {{ $post->categories->contains($category->id)?'checked':'' }} />
                        <label class="form-check-label" for="flexCheckChecked">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @if( isset($post->thumbnail))
        <div class="row">
            <div class="col col-md-12">
                <a href="{{ route('site.arquivo',['nome' =>$post->image]) }}" target="blank">
                        <img id="imagePreview" src="{{ $post->getImage() }}" alt="{{ $post->title }}" width="30%"/>
                </a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col col-md-12">
                <img id="imagePreview" src="{{ asset('assets/img/image-not-found.png') }}" alt="{{ $post->title }}" width="30%"/>
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
                <label for="content_preview"  class="form-label">Prévia do Conteúdo</label>
                <textarea id="nottiny" class="form-control" min-height="200" name="content_preview">{{ $post->content_preview }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3">
                <label for="content" class="form-label">Conteúdo</label>
                <textarea id="tiny" name="content">{{ $post->content }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3">
                <label for="content" class="form-label">Conteúdo</label>
                <select id="status" name="status" class="form-select">
                    <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Publicado</option>
                    <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Não Publicado</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3">
                <label for="content" class="form-label">Destaque</label>
                <select id="highlighted" name="highlighted" class="form-select">
                    <option value="1" {{ $post->highlighted == 1 ? 'selected' : '' }}>Destacado</option>
                    <option value="0" {{ $post->highlighted == 0 ? 'selected' : '' }}>Não Destacado</option>
                </select>
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
        plugins: 'lists link image media table code autoresize',
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
        {{-- $('.select-categoria').select2(); --}}

    });

</script>
@endsection
