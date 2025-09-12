<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Registro extends Component
{

    public $name = '';
    public $email = '';
    public $password = '';
    public $user;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $this->user = DB::table('users')->insert([
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        if( $this->user ) {
            $this->redirect('/home');
        }
        
        
    }


    public function render()
    {
        return view('livewire.users.registro');
    }
}
