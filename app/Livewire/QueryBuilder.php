<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class QueryBuilder extends Component
{
    public $conditions = [];  // Stores conditions dynamically
    public $result = [];      // Stores query results

    public $fields = ['name', 'email', 'created_at'];  // Example fields
    public $operators = ['=', '>', '<', 'LIKE'];       // Example operators

    public function mount()
    {
        $this->addCondition();
    }

    public function addCondition()
    {
        $this->conditions[] = [
            'method'=> '',
            'field' => '',
            'operator' => '=',
            'value' => '',
            'connector' => 'AND'
            
        ];
    }

    public function removeCondition($index)
    {
        unset($this->conditions[$index]);
        $this->conditions = array_values($this->conditions);  // Reindex conditions array
    }

    public function executeQuery()
    {
        dd($this->conditions);
        /*/
        $query = DB::table('your_table');  // Replace with your table name

        foreach ($this->conditions as $condition) {
            if (!empty($condition['field']) && !empty($condition['operator']) && isset($condition['value'])) {
                if ($condition['connector'] === 'AND') {
                    $query->where($condition['field'], $condition['operator'], $condition['value']);
                } else {
                    $query->orWhere($condition['field'], $condition['operator'], $condition['value']);
                }
            }
        }


        $this->result = $query->get()->toArray();
        */
    }

    public function render()
    {
        return view('livewire.query-builder');
    }
}
