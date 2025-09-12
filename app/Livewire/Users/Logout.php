<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{

    public function mount()
    {
        Session::forget('usuario');
        Auth::logout();
        
    }

    public function render()
    {
        return view('livewire.home');
    }
}
