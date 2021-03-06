<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link" active-class="active" exact>
                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fab fa-blogger yellow"></i>
                <p>
                    Blog
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link" active-class="active" exact>
                        <i class="fas fa-boxes nav-icon"></i>
                        <p>Categorias</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tag.index') }}" class="nav-link" active-class="active" exact>
                        <i class="fas fa-tags nav-icon"></i>
                        <p>Tags</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-newspaper nav-icon"></i>
                        <p>
                            Posts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}" class="nav-link">
                                <i class="fas fa-plus-circle nav-icon"></i>
                                <p>Novo Post</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.index') }}" class="nav-link" active-class="active" exact>
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Todos Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.trashed') }}" class="nav-link" active-class="active" exact>
                                <i class="fas fa-trash-alt nav-icon"></i>
                                <p>Posts Excluídos</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>
        @if(Auth::user()->isAdmin())
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Configurações
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link" active-class="active" exact>
                        <i class="fas fa-users nav-icon"></i>
                        <p>Usuários</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link" active-class="active" exact>
                        <i class="fas fa-cog nav-icon"></i>
                        <p>Configurações</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <li class="nav-item">
            <a href="{{ route('user.profile') }}" class="nav-link" active-class="active" exact>
                <i class="nav-icon fas fa-user-alt green"></i>
                <p>
                    Perfil
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-power-off red"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
