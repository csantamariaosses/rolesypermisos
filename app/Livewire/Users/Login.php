<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 

class Login extends Component
{

    #[Session]
    public $usuario = '';

    public $email = '';
    public $password = '';
    public $_id = 0;
    public $user = null;

    public function login(){
                
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            Session::put('usuario', Auth::user()->email);
            Session::put('roles', Auth::user()->getRoleNames());
            Session::put('permisos', Auth::user()->getAllPermissions());


            if (strstr(Auth::user()->email, "admin")) {
                return redirect()->route('admin.home');
            } else {
                //dd("usuario normal");
                return redirect()->route('users');
            }

        } else {
            session()->flash('error', 'Credenciales incorrectas');
            return redirect()->route('login');
        }
    }


    public function logout(){
        Session::forget('usuario');
        return view('livewire.home');
    }


    public function render()
    {
        return view('livewire.users.login');
    }
}
