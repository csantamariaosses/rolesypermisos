<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class CambioPassword extends Component
{

    #[Session]
    public $usuario;

    public $user;
    public $email;
    public $passwordActual;
    public $passwordNueva;
    public $passwordNuevaConfirm;


    public function mount()
    {
        //dd( $this->usuario);
        //dd($this->passwordActual, $this->passwordNueva, $this->passwordNuevaConfirm);

    }

    public function cambiarPassword()
    {
        //dd("cambioPassword");

        
        $this->validate([
            'passwordActual' => 'required',
            'passwordNueva' => 'required|min:6',
            'passwordNuevaConfirm' => 'required|min:6|same:passwordNueva'
        ]);

        // Aquí iría la lógica para cambiar la contraseña del usuario
        // Por ejemplo, verificar que la contraseña actual es correcta,
        // y luego actualizarla con la nueva contraseña.
        //dd($this->passwordActual, $this->passwordNueva, $this->passwordNuevaConfirm);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->passwordActual])) {
                $this->user = DB::table('users')->where('email', $this->email)->first();
                //dd($this->user->id);
                $affectedRows = DB::table('users')
                    ->where('id', $this->user->id)
                    ->update(['password' => bcrypt($this->passwordNueva)]);

                if ($affectedRows > 0) {
                    //dd("password actualizada");
                    session()->flash('message', 'Contraseña cambiada exitosamente.');
                } else {
                    //dd("password no actualizada");
                    session()->flash('message', 'No se pudo actualizar La contraseña.');
                }
                
        } else {
            session()->flash('error', 'La contraseña actual es incorrecta.');
        }

        $this->render();
    }


    public function render()
    {

        //dd( Session::get('usuario') );
        $this->email = Session::get('usuario');

        //dd($this->email);
        //$this->email = $this->usuario->email;
        //$this->user = $this->usuario->name;
        return view('livewire.users.cambio-password');
    }
}
