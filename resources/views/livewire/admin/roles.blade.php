<div>
    <STYLE>
        #NuevoRegistroModal, #editaRegistroModal {
            background-color: rgba(237, 234, 241, 0.3) !important;
        }
    </STYLE>

    <p>Admin Roles</p>
    <div class="row">
        <div class="col-3" style="background-color: lightgreen"></div>
        <div class="col-6">
            <h4>Listado de Roles</h4>
        </div>
        <div class="col-3" style="background-color: lightgreen"></div>
    </div>
    <div class="row">
        <div class="col-3" style="background-color: lightgreen"></div>
        <div class="col-6">
            <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#NuevoRegistroModal">Nuevo Rol</button>   
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
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)
                    <tr>
                        <th scope="row">{{ $registro->id }}</th>
                        <td>{{ $registro->name }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editaRegistroModal" wire:click="edit({{$registro->id}})">Edit</button>
                            <button class="btn btn-danger" wire:click="eliminar({{ $registro->id }})">Eliminar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Rol</h5>
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
                        <button type="button" class="btn btn-primary"   data-bs-dismiss="modal" wire:click="store">Guardar...</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Fin Modal nuevo registro -->


    <!-- Edita Registro -->

    <!-- Edita Registro Modal Único -->
    <div class="modal fade" id="editaRegistroModal" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="nombre" wire:model.lazy="name" required>
                        @error('name')
                            <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>     
                    <div class="mb-3">
                        <p>Permisos</p>
                        <p>https://www.youtube.com/watch?v=t8-vV4F71uE</p>
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
                    </div>
                </div>
                
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"   data-bs-dismiss="modal" wire:click="update">Guardar::</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Fin Modal Edita registro -->
</div>