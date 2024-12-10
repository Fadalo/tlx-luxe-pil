<?php

namespace App\Livewire;

use Livewire\Component;


class AdminNotification extends Component
{
    public $user_id = '';

    public mount(){

    }
    public function render()
    {
        return view('livewire.admin-notification');
    }
}
