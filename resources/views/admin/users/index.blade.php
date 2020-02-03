@extends('layouts.admin.master')

@section('title')
Usuários
@endsection

@section('content')
    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Usuários</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Usuários</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->

<section class="content">
            <div class="card card-solid">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-2x fa-users"></i>
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-circle float-right"><i class="fas fa-plus"></i></a>
                </div>
                <div class="card-body pb-0">
                    @foreach($users->chunk(3) as $chunk)

                    <div class="row d-flex align-items-stretch">
                        @foreach($chunk as $user)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light">
                              <div class="card-header text-muted border-bottom-0">
                                @if ($user->role === 'admin')
                                    Administrador
                                @else
                                    Escritor
                                @endif
                                <div class="float-right">
                                <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="sm" data-on="Ativo" data-off="Inativo" {{ $user->status ? 'checked' : '' }}>
                                </div>
                              </div>
                              <div class="card-body pt-0">
                                <div class="row">
                                  <div class="col-7">
                                    <h2 class="lead m-2"><b>{{ $user->name }}</b></h2>
                                    <p class="text-muted text-sm"><b>Sobre mim: </b>{{ $user->profile->about }} </p>
                                    <p class="text-muted text-sm"><b>Posts: </b>{{ $user->posts->count() }} </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email #: {{ $user->email }}</li>
                                    </ul>
                                  </div>
                                  <div class="col-5 text-center">
                                    <img src="{{ asset($user->profile->avatar) }}" alt="" class="img-circle img-fluid">
                                  </div>
                                </div>
                              </div>
                              <div class="card-footer">
                                <div class="text-right">

                                  @if (!$user->isAdmin())

                                    <a href="{{ route('user.admin', ['id' => $user->id]) }}" class="btn btn-sm bg-teal">
                                            <i class="fas fa-user-cog"></i> Tornar Administrador
                                        </a>
                                  @else
                                    <a href="{{ route('user.not.admin', ['id' => $user->id]) }}" class="btn btn-sm bg-teal">
                                        <i class="fas fa-lock"></i> Remover Permissões
                                    </a>
                                  @endif

                                  @if(Auth::id() !== $user->id )
                                  <button onclick="handleDelete({{ $user->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Deletar
                                  </button>
                                  @endif

                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                    </div>
                    @endforeach

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
              <h5 class="modal-title" id="deleteModalLabel">Apagar Usuário</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center text-bold">
                  Você realmente quer apagar esse Usuário?
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
$(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })

function handleDelete(id){
        var form = document.getElementById('deleteForm')
        form.action = '/admin/user/' + id
        $('#deleteModal').modal('show')
    }

</script>
@endsection
