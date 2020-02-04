@extends('layouts.admin.master')

@section('title')
Configurações do Site
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Configurações do Site</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Configurações</li>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-2x fa-cog"></i>

                </div>
                @include('admin.includes.errors')

                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nome do Site</label>
                                <input type="text" name="site_name" value="{{ !empty($settings->site_name) ? $settings->site_name:'' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Disponível</label>
                                <input type="text" name="disponible" value="{{ !empty($settings->disponible) ? $settings->disponible:'' }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">País/Estado</label>
                                <input type="text" name="country" value="{{ !empty($settings->country) ? $settings->country:'' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Endereço</label>
                                <input type="text" name="address" value="{{ !empty($settings->address) ? $settings->address:'' }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Telefone para contato</label>
                                <input type="text" name="contact_number" value="{{ !empty($settings->contact_number) ? $settings->contact_number:'' }}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Email para contato</label>
                                <input type="text" name="contact_email" value="{{ !empty($settings->contact_email) ? $settings->contact_email:'' }}" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                                <div class="col">
                                    <div class="mb-2"><b>Redes Sociais</b></div>
                                        <div class="row p-2">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Perfil do Facebook</label>
                                                    <input class="form-control" type="text" name="facebook" value="{{ !empty($settings->facebook) ? $settings->facebook:'' }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name">Perfil do Youtube</label>
                                                    <input type="text" name="youtube" value="{{ !empty($settings->youtube) ? $settings->youtube:'' }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name">Perfil do Twitter</label>
                                                    <input type="text" name="twitter" value="{{ !empty($settings->twitter) ? $settings->twitter:'' }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="name">Perfil do Instagram</label>
                                                    <input type="text" name="instagram" value="{{ !empty($settings->instagram) ? $settings->instagram:'' }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Logo</label>
                                            <input type="file" name="logo" value="{{ !empty($settings->logo) ? $settings->logo:'' }}" class="form-control file-upload">
                                        </div>
                                        @if (isset($settings))
                                            <div class="form-group col-md-6 text-center">
                                                <img src="{{ asset($settings->logo) }}" class="logo img-thumbnail" alt="" style="max-width: 10rem">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-warning" type="reset">Resetar</button>
                                        <button class="btn btn-success" type="submit">Atualizar</button>
                                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')
<script>
$(document).ready(function() {


var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.logo').attr('src', e.target.result);
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
