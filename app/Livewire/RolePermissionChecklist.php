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
    public function checkAllView(){
        foreach($this->data['menu'] as $key => $menu){
            
              
                 $da[] = [ $key=> [
                                    'view' => true
                 ]];
                       
                
            
        }
        $this->form = $da;
        
    }
    public function checkAllCreate(){

    }
    public function checkAllEdit(){

    }
    public function checkAllDelete(){

    }
    public function doSavePermission(){
       // dd($this->form);
        $role = Role::find($this->role_id);
        $role->role_permission = $this->form;
        $role->save();
        $this->triggerAlert('Berhasil Simpan Role Permission !!!',$title='Success!',$icon='success');
    }
    public function triggerAlert($msg,$title='Success!',$icon='success')
    {
        // Emit event to frontend to trigger SweetAlert
        $this->dispatch('swal:alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $msg,
        ]);
    }
    
}
