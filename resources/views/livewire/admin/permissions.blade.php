<div>
    <STYLE>
        #NuevoRegistroModal, #editaRegistroModal {
             background-color: rgba(237, 234, 241, 0.3) !important;
            /*opacity: 0.5 !important;*/
        }
    </STYLE>
    <p>Admin</p>
    <div class="row">
        <div class="col-3" style="background-color: lightgreen"></div>
        <div class="col-6">
            <h4>Listado de Permisos</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-3" style="background-color: lightgreen"></div>
        <div class="col-6">
            <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#NuevoRegistroModal">Nuevo Permiso</button>   
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
                            <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#eliminaRegistroModal" wire:click="confirmEliminar({{ $registro->id }})">Eliminar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" placeholder="Nombre" wire:model.lazy="name" required>
                        @error('name')
                            <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>        
                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"   data-bs-dismiss="modal" wire:click="store">Guardar</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Permiso</h5>
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
                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"   data-bs-dismiss="modal" wire:click="update">Guardar</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Fin Modal Edita registro -->


    <!-- Elimina Registro -->
    <!-- Elimina Registro Modal Único -->
    <div class="modal fade" id="eliminaRegistroModal" wire:ignore.self tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Elimina Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Seguro que desea eliminar el permiso: <b>{{ $name }}</b></label>

                    </div>        
                </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                        <button type="button" class="btn btn-danger"   data-bs-dismiss="modal" wire:click="destroy">Confirmar</button>
                </div>
            </div> <!-- Modal content -->
        </div> <!-- Modal dialog -->
    </div>   <!-- Fin Modal Edita registro -->
</div>
