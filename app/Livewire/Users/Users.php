<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Users extends Component
{
    #[Session]
    public $usuario;

    public $user;
    public $email;

    public $usuarios;

    public function mount()
    {
        $this->usuario = Session::get('usuario');
    }

    public function create(){
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        session()->flash('message', 'Usuario creado exitosamente.');

        // Limpiar los campos del formulario
        $this->reset(['email', 'password']);
    }
    public function render()
    {
        return view('livewire.users.users');
    }
}
