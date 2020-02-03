@extends('layouts.admin.master')

@section('title')
Editar Perfil
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Editar Perfil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Editar Perfil</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<section class="content">
    <div class="row justify-content-md-center">
        <div class="col-12">
            @include('admin.includes.errors')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Adicionar Usuário</h3>
                </div>
                <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="row flex-lg-nowrap">
                        <div class="col">
                            <div class="row">
                            <div class="col mb-3">
                                <div class="card-body">
                                    <div class="e-profile">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <div class="d-flex justify-content-center align-items-center rounded">
                                                <img src="{{ asset($user->profile->avatar) }}" alt="..." class="avatar img-thumbnail">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name}}</h4>
                                            <div class="mt-2">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fa fa-fw fa-camera"></i>
                                                <span>Trocar foto</span>
                                                <input type="file" name="avatar" id="file" class="customFile file-upload">
                                            </button>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-right">
                                            <span class="badge badge-secondary">
                                                @if ($user->role === 'admin')
                                                    Administrador
                                                @else
                                                    Escritor
                                                @endif
                                            </span>
                                            <div class="text-muted"><small>Entrou em: {{ $user->created_at->format('d/m/Y') }}</small></div>
                                        </div>
                                        </div>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="" class="active nav-link">Configurações</a></li>
                                    </ul>
                                    <div class="tab-content pt-3">
                                        <div class="tab-pane active">
                                            <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Nome Completo</label>
                                                    <input class="form-control" type="text" name="name" placeholder="John Smith" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="email" name="email" placeholder="user@example.com" value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="col mb-3">
                                                    <div class="form-group">
                                                    <label>Sobre</label>
                                                    <textarea class="form-control" rows="5" name="about" placeholder="Sobre Você">{{ $user->profile->about }}</textarea>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-2"><b>Redes Sociais</b></div>
                                                        <div class="row p-2">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Perfil do Facebook</label>
                                                                    <input class="form-control" type="text" name="facebook" value="{{ $user->profile->facebook }}">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="name">Perfil do Linkedin</label>
                                                                    <input type="text" name="linkedin" value="{{ $user->profile->linkedin }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row p-2">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="name">Perfil do Twitter</label>
                                                                    <input type="text" name="twitter" value="{{ $user->profile->twitter }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="name">Perfil do Instagram</label>
                                                                    <input type="text" name="instagram" value="{{ $user->profile->instagram }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <div class="row">
                                            <div class="col">
                                                <div class="mb-2"><b>Trocar Senha</b></div>
                                                <div class="row p-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Nova Senha</label>
                                                    <input class="form-control" type="password" placeholder="••••••">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                    <label>Confirme <span class="d-none d-xl-inline">Senha</span></label>
                                                    <input class="form-control" type="password" placeholder="••••••"></div>
                                                </div>
                                            </div>
                                            </div>

                                            </div>
                                            <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-warning m-2" type="reset">Resetar</button>
                                                <button class="btn btn-primary m-2" type="submit">Atualizar</button>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            </div>

                        </div>
                        </div>
                    </form>

                </div>
                </div>
                </div>
</section>
@section('js')
<script>
$(document).ready(function() {


var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.avatar').attr('src', e.target.result);
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
@stop
