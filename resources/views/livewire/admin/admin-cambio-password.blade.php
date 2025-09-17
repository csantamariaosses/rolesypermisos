<div>
    <p>Cambio Password</p>
    <div class="container">
        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <H3>CAMBIO DE CONTRASEÑA admin</H3>
                    </div>
                    <div class="card-body">
                @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                @endif
                @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                @endif
                <form  wire:submit.prevent="cambiarPassword">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" wire:model="email" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="pwd" class="form-label">Password Actual:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="passwordActual" wire:model="passwordActual">
                    </div>
                    <div class="mb-3">
                        <label for="pwdNuevo" class="form-label">Password Nueva:</label>
                        <input type="password" class="form-control" id="pwdNuevo" placeholder="Enter new password" name="passwordNuevo" wire:model="passwordNueva">
                    </div>
                    <div class="mb-3">
                        <label for="pwdNuevoConfirm" class="form-label">Confirmar Password Nueva:</label>
                        <input type="password" class="form-control" id="pwdNuevoConfirm" placeholder="Confirm new password" name="passwordNuevoConfirm" wire:model="passwordNuevaConfirm">
                    </div>

                    <button type="button" class="btn btn-primary">Volver</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
