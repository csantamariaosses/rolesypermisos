<div>
    <style>
        .error { color: red; }
    </style>
    <p>Cambio Password</p>
    <div class="container">
        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <H3>CAMBIO DE PASSWORD NORMAL</H3>
                    </div>
                    <div class="card-body">
                        @if (session('messages'))
                        <div class="alert alert-danger">
                            {{ session('messages') }}
                        </div>
                        @endif

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
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="passwordActual" wire:model.lazy="passwordActual">
                                @error('passwordActual') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pwdNuevo" class="form-label">Password Nueva:</label>
                                <input type="password" class="form-control" id="passwordNueva" placeholder="Enter new password" name="passwordNueva" wire:model.lazy="passwordNueva">
                                @error('passwordNueva') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pwdNuevoConfirm" class="form-label">Confirmar Password Nueva:</label>
                                <input type="password" class="form-control" id="passwordNuevaConfirm" placeholder="Confirm new password" name="passwordNuevaConfirm" wire:model.lazy="passwordNuevaConfirm">
                                @error('passwordNuevaConfirm') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div> <!-- card body -->
                </div> <!-- card -->    
            </div> <!-- col-6 -->
            <div class="col-3"></div>
        </div> <!-- row --> 
    </div>
</div>
