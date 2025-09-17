<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Permission;

class Permissions extends Component
{

    public $_id;
    public $name;
    public $guard_name = 'web';


    public function store(){
        $this->validate([
            'name' => 'required|string|max:255'
        ]);

        Permission::create([
            'name' => $this->name,
            'guard_name' => $this->guard_name,
        ]);

        //$this->reset();    
        $this->dispatch('NuevoRegistroModal');
    }

    public function edit($id)
    {
        $registro = Permission::find($id);
        $this->_id = $id;
        $this->name = $registro->name;
        $this->guard_name = $registro->guard_name;

        $this->dispatch('editaRegistroModal');
    }

    public function update()
    {
        
        $this->validate([
            'name' => 'required|string|max:255'
        ]);

        $registro = Permission::find($this->_id);
        $registro->name = $this->name;
        $registro->guard_name = $this->guard_name;
        $registro->save();

        $this->reset();
        $this->dispatch('editaRegistroModal');
        
    }

    public function confirmEliminar($id)
    {
        $this->_id = $id;
        $this->name = Permission::find($id)->name;

    }


    public function destroy()
    {
        $registro = Permission::find($this->_id);
        $registro->delete();

        $this->reset();
        $this->dispatch('eliminaRegistroModal');
    }


    public function render()
    {
        $registros = Permission::orderBy('name')->get();
        return view('livewire.admin.permissions', compact('registros') )->layout('components.layouts.app');
        
    }
}
