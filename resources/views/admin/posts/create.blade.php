@extends('layouts.admin.master')

@section('title')
{{ isset($post) ? 'Editar Post': 'Novo Post'}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ isset($post) ? 'Editar Post': 'Novo Post'}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{ isset($post) ? 'Editar Post': 'Novo Post'}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-12">
            @include('admin.includes.errors')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ isset($post) ? 'Editar Post': 'Novo Post'}}</h3>
                </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form role="form" action="{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if (isset($post))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ isset($post) ? $post->title: '' }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea type="text" name="description" id="description" cols="5" rows="5" class="form-control">{{ isset($post) ? $post->description: '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="content">Conteúdo</label>
                            <input name="content" id="contents" type="hidden" value="{{ isset($post) ? $post->content: '' }}">
                            <trix-editor input="contents"></trix-editor>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="published_at">Publicado em</label>
                            <input type="text" name="published_at" id="published_at" class="form-control" value="{{ isset($post) ? $post->published_at: '' }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="category">Categoria</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id}}" @if(isset($post)) @if($category->id === $post->category_id) selected  @endif @endif>{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if($tags->count() > 0)
                        <div class="form-group col-md-4">
                            <label for="tags">Tags</label>
                            <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @if (isset($post))
                                    @if($post->hasTag($tag->id))
                                        selected
                                    @endif
                                    @endif
                                    >
                                    {{ $tag->tag }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">Imagem</label>
                        <input type="file" name="image" id="image" class="form-control file-upload">
                    </div>
                    @if (isset($post))
                    <div>
                        <img  class="img-thumbnail rounded mx-auto d-block image" src="{{ asset($post->image) }}" alt="">
                    </div>
                    @endif
                    <div>
                        <img  class="img-thumbnail rounded mx-auto d-block image" src="" alt="">
                    </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                        <button class="btn btn-warning" type="reset">Resetar</button>
                        <button type="submit" class="btn btn-primary">{{ isset($posts) ? 'Atualizar': 'Salvar'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.2/l10n/pt.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true,
        "locale": "pt",
        enableSeconds: true
    })

    $(document).ready(function() {
        $('.tags-selector').select2();
    });
    $(document).ready(function() {


var readURL = function(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
    $('.image').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}
}


$(".file-upload").on('change', function(){
readURL(this);
});
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
@endsection
