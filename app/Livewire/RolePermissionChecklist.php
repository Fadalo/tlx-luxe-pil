<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Config;
use App\Models\Role\Role;

class RolePermissionChecklist extends Component
{
    public $data =  '';
    public $role_id = '';
    public $form = [];
    public function mount(){
        $this->data = config('menu-admin');
    }
    public function render()
    {
        return view('livewire.role-permission-checklist');
    }
    public function doSavePermission(){
       // dd($this->form);
        $role = Role::find($this->role_id);
        $role->role_permission = $this->form;
        $role->save();
    }
}
