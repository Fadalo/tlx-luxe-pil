<?php

namespace App\Livewire;

use Livewire\Component;

class PackageOrderActivatedGrid extends Component
{
    public $member_package_order_id = '';
    
    public function booksession(){
        //dd($this->member_package_order_id);
        $this->dispatch('showModalBooking',['member_package_order_id'=>$this->member_package_order_id]);
    }
    public function detailsession(){
       // dd($this->member_package_order_id);
        $this->dispatch('showModalDetail',['member_package_order_id'=>$this->member_package_order_id]);
    }
    public function render()
    {
        return view('livewire.package-order-activated-grid');
    }
}
