@extends('layouts.admin.master')

@section('title')
Tags
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tags</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tags</li>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-2x fa-box"></i>
                        <a href="{{ route('tag.create') }}" class="btn btn-primary btn-circle float-right"><i class="fas fa-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Quantidade de Posts</th>
                                    <th>Editar</th>
                                    <th>Apagar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($tags->count() > 0)
                            @foreach ($tags as $t)
                                <tr>
                                    <td>{{ $t->tag }}</td>
                                    <td> {{ $t->posts->count() }}</td>
                                    <th scope="row">
                                        <a href="{{ route('tag.edit', $t->id ) }}" class="btn btn-info btn-circle btn-lg"><i class="fas fa-pen-alt"></i>
                                        </a>
                                    </th>
                                    <th><button class="btn btn-danger btn-circle btn-lg" onclick="handleDelete({{ $t->id }})"><i class="fas fa-trash-alt"></i> </button>
                                    </th>
                                </tr>
                            @endforeach
                            @else
                            <th colspan="5" class="text-center">Sem Tags cadastradas</th>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<form action="" method="POST" id="deletetagForm">
    @csrf
    @method('DELETE')
      <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Apagar Tag</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center text-bold">
                  Você realmente quer apagar essa tag?
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
        var form = document.getElementById('deletetagForm')
        form.action = '/admin/tag/' + id
        $('#deleteModal').modal('show')
    }
    </script>
@endsection
