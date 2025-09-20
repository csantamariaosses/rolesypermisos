<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class Users extends Component
{

    public $usuarios;
    public $usuario;
    public $name;
    public $nombre, $email, $roles, $_id;
    public $accion = "Agregar";
    public $password;
    public $permissions = [];
    public $rol;
    public $selectedPermissions = [];
    public $selectedRoles = [];
    public $rolSelected = 0;
    public $rolesCheckbox = [];
    public $permisosCheckbox = [];
    public $rolesDB = [];
    public $i=0;
    public $checkBoxCambiaPassword = false;
    public $isDisabled = true;
    
    public function mount()
    {
        $this->usuarios = User::all();
    }   

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:7',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $this->limpiarCampos();
        $this->dispatch('NuevoRegistroModal');
        session()->flash('message', 'Usuario creado exitosamente.');
    }


    public function edit($id)
    {
        $this->usuario = User::find($id);
        //dd( $this->usuario);

        $this->_id = $id;

        $this->name = $this->usuario->name;
        $this->email = $this->usuario->email;
        
        $this->permissions = Permission::all();
        $this->permisosCheckbox = $this->usuario->permissions()->pluck('id')->toArray();

        $this->roles = Role::all();
        $this->rolesCheckbox = $this->usuario->roles()->pluck('id')->toArray();

    }   


    public function update(){
        $i = 0;        
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        app()['cache']->forget('spatie.permission.cache');

        $usuario = User::find($this->_id);

        $usuario->name = $this->name;
        $usuario->email = $this->email;
        $usuario->save();
        //$role = Role::find($this->rolSelected);

        if( $this->isDisabled == false ){ 
                $this->validate([
                    'password' => 'required|string|min:7',
                ]);
                $usuario->password = bcrypt($this->password);
                $usuario->save();   
        }
        
        //Asignar permisos
        foreach($this->permisosCheckbox as $permisoId){
            $this->permisosCheckbox[$i] = (int) $this->permisosCheckbox[$i];    
            $i++;
        }

        $usuario->syncPermissions( $this->permisosCheckbox);
     
        //Asignar roles
        $i = 0;
        foreach($this->rolesCheckbox as $rolId){
            $this->rolesCheckbox[$i] = (int) $this->rolesCheckbox[$i];    
            $rolName = Role::find($this->rolesCheckbox[$i]);
            $usuario->assignRole( $rolName->name);
            $i++;
        }

        $this->limpiarCampos();
        session()->flash('message', 'Usuario actualizado exitosamente.');

    }


    public function limpiarCampos(){
        $this->id = 0;
        $this->nombre = "";
        $this->rol = "";

    }


    public function activarCambioPassword(){
        $this->isDisabled = !$this->isDisabled;
    }

    public function render()
    {
        $this->usuarios = User::all();
        $this->roles = Role::all();
        $this->permissions = Permission::all();

        return view('livewire.admin.users', [ 
            'usuarios' => $this->usuarios, 
            'roles' => $this->roles, 
            'selectedRoles' => $this->selectedRoles,
            'rolSelected' => $this->rolSelected,
            'permissions' => $this->permissions ])->layout('components.layouts.app');
    }
}
