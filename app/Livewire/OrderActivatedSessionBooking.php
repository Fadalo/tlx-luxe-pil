<?php

namespace App\Livewire;

use Livewire\Component;

class OrderActivatedSessionBooking extends Component
{
    public $config = [];
    public $meta = [
        'member_package_order_id' => ['type'=> 'dropdown' , 'label' => 'Member Package', 'default' => ''],
        'session_id'=> ['type'=> 'text' , 'label' => '', 'default' => ''],
        'session_date' => ['type'=> 'text' , 'label' => '', 'default' => ''],
        'session_duration' => ['type'=> 'text' , 'label' => '', 'default' => ''],
        'qty_ticket_used' => ['type'=> 'text' , 'label' => '', 'default' => ''],
        'qty_ticket_available' => ['type'=> 'text' , 'label' => '', 'default' => ''],
        'status_session' => ['type'=> 'text' , 'label' => '', 'default' => ''],
        'is_member_created' => ['type'=> 'text' , 'label' => '', 'default' => ''],
        'status_document' => ['type'=> 'text' , 'label' => '', 'default' => ''],
    ];
    
    public function render()
    {
        return view('livewire.order-activated-session-booking');
    }
}
