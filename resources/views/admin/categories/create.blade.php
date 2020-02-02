@extends('layouts.admin.master')

@section('title')
Nova Categoria
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Nova Categoria</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Nova Categoria</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            @include('admin.includes.errors')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Adicionar Categoria</h3>
                </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form role="form" action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="post">
                    {{ csrf_field() }}
                    @if (isset($category))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Nome</label>
                            <input type="text" class="form-control" id="" name="name" value="{{ isset($category) ? $category->name : old('name') }}">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                        <button class="btn btn-warning" type="reset">Resetar</button>
                        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Atualizar': 'Salvar'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
