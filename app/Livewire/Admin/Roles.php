<?php

namespace App\Livewire\Admin;

use Livewire\Component;
//use App\Models\Role;
//use App\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
//use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class Roles extends Component
{

    //use HasPermissions; 
    
    public $registros;
    public $_id;
    public $NewNombre;
    public $nombre;
    public $name;
    public $role;
    public $permissions = [];
    public $permisosCheckbox = [];

    public function store(){
        
        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]); 
        $this->limpiarCampos();
        $this->dispatch('NuevoRegistroModal');
    }

    public function edit($id)
    {

        $this->_id = $id;
        $this->role = Role::find($id);
        $this->name = $this->role->name;
        
        app()['cache']->forget('spatie.permission.cache');

        
        $this->permissions = Permission::all();
        $this->permisosCheckbox = $this->role->permissions()->pluck('id')->toArray();

        /*
        $i = 0;
        foreach( $this->permissions as $permission ){
            $role->hasPermissionTo( $permission->name ) ? $permission->checked = true : $permission->checked = false;
            $this->permisosCheckbox[$i] = $permission->checked;
            $i++;
        }
            */
        //dd( $this->permisosCheckbox );  

    }

    public function update()
    {


        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        $role = Role::find($this->_id);
        $role->name = $this->name;



        //Asignar permisos
        
        $i = 0;
        foreach($this->permisosCheckbox as $permisoId){
            $this->permisosCheckbox[$i] = (int) $this->permisosCheckbox[$i];    
            $i++;
        }
            
       
           
        foreach( $this->permisosCheckbox as $permission ){
            $permission =  Permission::find($permission);
            $role->givePermissionTo($permission->name);
        }

       // $role->syncPermissions($this->permisosCheckbox);    

        $role->save();
        $this->dispatch('editaRegistroModal');
        $this->limpiarCampos();
        

    }

    public function limpiarCampos()
    {
        $this->name = '';
    }

    public function render()
    {
        
        $this->registros = Role::all();
        return view('livewire.admin.roles', [ 'registros' => $this->registros ])->layout('components.layouts.admin');
    }
}
