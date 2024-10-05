<?php

namespace App\Livewire;

use Livewire\Component;

class InlineCrud extends Component
{
    public $count = 0;
    public function increment()
    {
        $this->count++;
    }
    public function render()
    {
        return view('livewire.inline-crud');
    }
}
