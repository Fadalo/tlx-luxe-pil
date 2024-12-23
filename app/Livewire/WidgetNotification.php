<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Settings\Notification;
use Illuminate\Support\Facades\Auth;

class WidgetNotification extends Component
{
    public $data = [];
    public $page = 0;
    public $limit = 10;
    public $admin_id = '';
    public function mount()
    {

       $this->admin_id = Auth::User()->id;
       $this->updateList();

    }
    public function updateList()
    {
        $this->data = Notification::where('to',$this->admin_id)->where('is_read','0')->limit(1)->get()->toArray();
    }

    public function viewAll(){
        $this->data = Notification::where('to',$this->admin_id)->where('is_read','0')->get()->toArray();

    }
    public function viewMore(){
        $this->data = Notification::where('to',$this->admin_id)->where('is_read','0')->get()->toArray();

    }
    public function render()
    {
        return view('livewire.widget-notification');
    }
}
