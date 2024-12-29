<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member\Member;
use Illuminate\Support\Facades\Auth;
class PanelMemberChangePin extends Component
{
    public $oldPin = '';
    public $newPin = '';
    public $verifiyPin = '';
    public function doChangePin()
    {
        $Member = AUTH::guard('member')->User();
        if ( $Member && Hash::check($this->oldPin, $Member->pin)) {
            
            if ($this->newPin == $this->verifiyPin){
                $Member->pin = Hash::make($this->newPin); 
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
        return view('livewire.panel-member-change-pin');
    }
}
