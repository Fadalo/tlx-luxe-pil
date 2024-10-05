<?php

namespace App\Livewire;

use Livewire\Component;

class DynamicGrid extends Component
{
    public $head =  [
        ['name' => 'col1','type'=>'text','value'=>'' ],
        ['name' => 'col2','type'=>'text','value'=>'' ],
        ['name' => 'col3','type'=>'text','value'=>'' ],
        ['name' => 'col4','type'=>'text','value'=>'' ],
        ['name' => 'col5','type'=>'text','value'=>'' ],
    ];
    public $data = [];
    public $counterL = 0;
    public $ids = '';
    public function  increment(){
        $row = 
            [
                ['name' => 'col1','type'=>'text','value'=> $this->counterL ],
                ['name' => 'col2','type'=>'dropdown','value'=> 'col2' ],
                ['name' => 'col3','type'=>'text','value'=>'col3' ],
                ['name' => 'col4','type'=>'text','value'=>'col4' ],
                ['name' => 'col5','type'=>'text','value'=>'col5' ],
            ]
        ;
        $this->counterL = $this->counterL + 1;
        $this->data[] =$row;
    }
    public function decrease($id){
        $this->ids = $id;
    }
    public function render()
    {
        return view('livewire.dynamic-grid');
    }
}
