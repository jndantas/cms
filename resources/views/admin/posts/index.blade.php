@extends('layouts.admin.master')

@section('title')
Posts
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Posts</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Posts</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-2x fa-newspaper"></i>
                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-circle float-right"><i class="fas fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Título</th>
                                    <th>Categoria</th>
                                    <th>Autor</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)

                                <tr>
                                    <td>
                                        <img src="{{ asset($post->image) }}" width="auto" height="60px" alt=""></td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $post->category->id) }}">
                                            {{ $post->category->name }}
                                        </a>
                                    </td>
                                    <td>{{ $post->user->name }}</td>

                                    @if($post->trashed())

                                    <th scope="row">
                                        <form action="{{ route('post.restore', $post->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                        <button class="btn btn-info btn-circle btn-lg"><i class="fas fa-recycle"></i></button>
                                        </form>
                                    </th>

                                    @else

                                    <th scope="row">
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-info btn-circle btn-lg"><i class="fas fa-pen-alt"></i></a>
                                    </th>

                                    @endif
                                    <th>

                                        @if ($post->trashed())
                                        <button type="submit" class="btn btn-danger btn-circle btn-lg" onclick="handleDelete({{ $post->id }})"><i class="fas fa-trash-alt"></i></button>

                                        @else
                                        <button type="submit" class="btn btn-warning btn-circle btn-lg" onclick="handleDelete({{ $post->id }})"><i class="fas fa-trash-restore-alt"></i></button>

                                        @endif
                                    </th>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<form action="" method="POST" id="deleteForm">
    @csrf
    @method('DELETE')
      <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Apagar Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center text-bold">
                  Você realmente quer apagar esse Post?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não, Volte!</button>
              <button type="submit" class="btn btn-danger">Sim, Apague!</button>
            </div>
          </div>
        </div>
      </div>
</form>

@endsection

@section('js')

<script>

function handleDelete(id){
        var form = document.getElementById('deleteForm')
        form.action = '/admin/post/' + id
        $('#deleteModal').modal('show')
    }
    </script>
@endsection
