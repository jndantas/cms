@extends('layouts.admin.master')

@section('title')
{{ isset($user) ? 'Editar Usuário' : 'Criar Usuário'}}
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ isset($user) ? 'Editar Usuário' : 'Criar Usuário'}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">{{ isset($user) ? 'Editar Usuário' : 'Criar Usuário'}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<section class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            @include('admin.includes.errors')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Adicionar Usuário</h3>
                </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form role="form" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="post">
                    {{ csrf_field() }}
                    @if (isset($user))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="" name="name" value="{{ isset($user) ? $user->name : old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                        <button class="btn btn-warning" type="reset">Resetar</button>
                        <button type="submit" class="btn btn-primary">{{ isset($user) ? 'Atualizar': 'Salvar'}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
