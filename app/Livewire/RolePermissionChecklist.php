<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Config;
use App\Models\Role\Role;

use Illuminate\Support\Facades\Auth;
class RolePermissionChecklist extends Component
{
    public $data =  '';
    public $role_id = '';
    public $form = [];
    public $selectedCheckAllView = false;
    public $selectedCheckAllCreate = false;
    public $selectedCheckAllEdit = false;
    public $selectedCheckAllDelete = false;
    
   
    
    public function mount(){
       // dd($this->role_id);
        $this->data = config('menu-admin');
        $role = Role::find($this->role_id);
       // dd($role->role_permission);
        $this->form =  (is_null(json_decode($role->role_permission,true))? []:json_decode($role->role_permission,true));

    }
    public function render()
    {
        return view('livewire.role-permission-checklist');
    }
  
    public function checkAllView(){
        if ($this->selectedCheckAllView == true){
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['view'] = true;    
            }
        } 
        else 
        {
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['view'] = false;    
            }
        }
       
    }
    public function checkAllCreate(){
        if ($this->selectedCheckAllCreate == true){
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['create'] = true;    
            }
        } 
        else 
        {
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['create'] = false;    
            }
        }
    }
    public function checkAllEdit(){
        if ($this->selectedCheckAllEdit == true){
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['edit'] = true;    
            }
        } 
        else 
        {
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['edit'] = false;    
            }
        }
    }
    public function checkAllDelete(){
        if ($this->selectedCheckAllDelete == true){
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['delete'] = true;    
            }
        } 
        else 
        {
            foreach($this->data['menu'] as $key => $menu){
                $this->form[$menu['name']]['delete'] = false;    
            }
        }
    }
    public function doSavePermission(){
       // dd($this->form);
        if (!Auth::check()) {
            return redirect('/login-new');
        }
        $role = Role::find($this->role_id);
        $role->role_permission = $this->form;
        $role->updated_at = now();
        $role->updated_by = Auth::User()->id;
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
