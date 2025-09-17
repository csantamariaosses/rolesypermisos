<div>
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admin/home" wire:navigate>Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/users" wire:navigate>Usuarios</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/permissions" wire:navigate>Permisos</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/admin/roles" wire:navigate>Roles</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>

                 @if(session()->has('usuario'))
                <li class="nav-item">
                <a class="nav-link" href="/cambioPassword" wire:navigate>Cambio de Contraseña</a>
                </li>
                @endif

                @if(session()->has('usuario'))
                <li class="nav-item">
                <a class="nav-link" href="/salir" wire:navigate>Salir</a>
                </li>
                @endif
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
        </nav>
</div>
