<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/home" wire:navigate>Home</a>
                </li>

                @if( session()->has('usuario') and session('roles')->contains('administrador') )
                <li class="nav-item">
                <a class="nav-link" href="/admin/users" wire:navigate>Usuarios</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/permissions" wire:navigate>Permisos</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/roles" wire:navigate>Roles</a>
                </li>
                @endif

                @if(!session()->has('usuario'))
                <li class="nav-item">
                <a class="nav-link" href="/login" wire:navigate>Login</a>
                </li>
                @endif

                @if( session()->has('usuario') and session('roles')->contains('dashboard') )
                <li class="nav-item">
                <a class="nav-link" href="/dashboard/crear" wire:navigate>Crear Dashboard</a>
                </li>
                @endif

                @if( session()->has('usuario') and session('roles')->contains('usuario') )   
                <li class="nav-item">
                <a class="nav-link" href="/dashboard" wire:navigate>Ver Dashboard</a>
                </li>
                @endif
               
                @if(session()->has('usuario'))
                <li class="nav-item">
                <a class="nav-link" href="/cambioPassword" wire:navigate>Cambio de Contraseña</a>
                </li>
                @endif

                @if(session()->has('usuario'))
                <li class="nav-item">
                <a class="nav-link" href="/logout" wire:navigate>Salir</a>
                </li>
                @endif

            </ul>

            </div>
        </div>
        </nav>
</div>
