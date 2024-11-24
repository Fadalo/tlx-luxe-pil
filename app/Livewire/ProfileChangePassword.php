<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;



class ProfileChangePassword extends Component
{
  

    public $config = [];
    public $user_id = '';
    public $old_password = '';
    public $new_password = '';
    public $confirm_password = '';
    
    public function doSave()
    {
    
        if($this->old_password != '' && $this->new_password != '' && $this->confirm_password != '' )
        {

            $user = User::find($this->user_id);
            dd($user);
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    if ($request->new_password == $request->confirm_password) {
                        $user->password = Hash::make($request->new_password);
                        $user->save();
                        $this->triggerAlert('New Password Save');
                    } else {
                        return redirect()->route('profile')->with('error', 'New password and confirm password does not match');
                    }
                } else {
                    return redirect()->route('profile')->with('error', 'Current password is incorrect');
                }
            } else {
                return redirect()->route('profile')->with('error', 'User not found');
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
