<?php

namespace App\Livewire;

use Livewire\Component;

class PackageOrderActivatedGrid extends Component
{
    public $member_package_order_id = '';
    
    public function render()
    {
        return view('livewire.package-order-activated-grid');
    }
}
