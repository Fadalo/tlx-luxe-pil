<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileChangePassword extends Component
{
  

    public $config = [];
    public $user_id = '';
    public $old_password = '';
    public $new_password = '';
    public $confirm_password = '';
    
    public function doSave()
    {
    
       // dd($this->old_password);
        if($this->old_password != '' && $this->new_password != '' && $this->confirm_password != '' )
        {

            $user = User::find($this->user_id);
           
            if ($user) {
                if (Hash::check($this->old_password, $user->password)) {
                    if ($this->new_password == $this->confirm_password) {
                        $user->password = Hash::make($this->new_password);
                        $user->save();
                        $this->triggerAlert('New Password Save');
                    } else {
                        $this->triggerAlert('new password and confirm not same','Error !!','error');
                    }
                } else {
                    $this->triggerAlert('old password incorrect','Error !!','error');
                }
            } else {
                $this->triggerAlert('User Not Found','Error !!','error');
            }
        }

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
    public function render()
    {
        return view('livewire.profile-change-password');
    }
}
