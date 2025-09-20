<div>
    <STYLE>
        #NuevoRegistroModal, #editaRegistroModal {
           background-color: rgba(237, 234, 241, 0.3) !important;
        }
    </STYLE>
    <p>Admin Users</p>
   <h3>Bienvenido:</h3>
    <h4>Listado de Usuarios</h4>
    <div class="row">
        <div class="col-3" style="background-color: lightgreen"></div>
        <div class="col-6">
            <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#NuevoRegistroModal">Nuevo Usuario</button>   
            @if (session('message'))
                <div class="alert alert-success">
                   {{ session('message') }}
                </div>
            @endif

        </div>
        <div class="col-3" style="background-color: lightgreen"></div>
    </div>
    <div class="row">
        <div class="col-3">

        </div>        
        <div class="col-6">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles()->pluck('name')->implode(', ') }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editaRegistroModal" wire:click="edit({{$user->id}})">Edit</button>
                            <button class="btn btn-primary" wire:click="editar({{ $user->id }})">Editar</button>
                            <button class="btn btn-danger">Eliminar</button>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    <!-- Modal Nuevo Registro -->
    <div class="modal fade" id="NuevoRegistroModal" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="nombre" wire:model.lazy="name" required>
                        @error('name')
                            <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>        
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="email" wire:model.lazy="email" required>
                        @error('email')
                            <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>        
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="password" wire:model.lazy="password" required>
                        @error('password')
                            <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>        
                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"   data-bs-dismiss="modal" wire:click="store">Guardar...</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Fin Modal nuevo registro -->



     <!-- Modal Edita -->
    <div class="modal fade" id="editaRegistroModal" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="name" wire:model.lazy="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="email" wire:model.lazy="email">
                    </div> 
                    <div class="mb-3">
                        <input type="checkbox" wire:click="activarCambioPassword"> Cambiar Password
                        <input type="password" class="form-control" id="password" placeholder="******************" wire:model.lazy="password" @if($isDisabled) disabled @endif>
                    </div>                                                                  
                    <div class="mb-3">
                        <p>Permisos Directos</p>
                        @foreach($permissions as $permiso)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $permiso->id}}" wire:model.lazy="permisosCheckbox"
                                @if( in_array($permiso->id, $permisosCheckbox) ) checked @endif
                                >                                 <label class="form-check-label" for="flexCheckRole">
                                    {{ $permiso->id}} - {{ $permiso->name}}
                                </label>
                            </div>
                        @endforeach
                        Permisos: {{ var_export($permisosCheckbox) }}
                        <hr>

                        <p>Roles</p>
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id}}" wire:model.lazy="rolesCheckbox"
                                @if( in_array($role->id, $rolesCheckbox) ) checked @endif
                                >                                 <label class="form-check-label" for="flexCheckRole">
                                    {{ $role->id}} - {{ $role->name}}
                                </label>
                            </div>
                        @endforeach
                        Roles: {{ var_export($rolesCheckbox) }}

                        <p>Permisos indirectos</p>
                        @foreach($rolesCheckbox as $role)
                            @php
                                $rolePermisos = \Spatie\Permission\Models\Role::find($role)->permissions;
                            @endphp
                            @foreach( $rolePermisos as $permiso )
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permiso->id}}" wire:model.lazy="permisosCheckbox"
                                    @if( in_array($permiso->id, $permisosCheckbox) ) checked @endif
                                    >                                 <label class="form-check-label" for="flexCheckRole">
                                        {{ $permiso->id}} - {{ $permiso->name}}
                                    </label>
                                </div>
                            @endforeach
                        @endforeach 
                        Permisos Indirectos:
                    </div>
                </div> <!-- Modal body -->                                                                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  data-bs-dismiss="modal" wire:click="update">Save changes</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Modal -->
    <!-- Fin Modal Edita -->


    <!-- Modal Aviso-->
    <div class="modal fade" id="AvisoModal" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="nombre" wire:model.lazy="name" required>
                        @error('name')
                            <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>        
                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"   data-bs-dismiss="modal" wire:click="store">Aceptar</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Fin Modal Aviso -->

</div>
