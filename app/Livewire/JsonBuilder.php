<?php

namespace App\Livewire;

use Livewire\Component;

class JsonBuilder extends Component
{
    public $jsonData = [];
    public $jsonPreview = '';

    public function addField()
    {
        $this->jsonData[] = ['key' => '', 'value' => '', 'type' => 'string'];
        $this->updateJsonPreview();
    }

    public function exportJson()
    {
        return response()->streamDownload(function () {
            echo $this->jsonPreview;
        }, 'json_output.json', ['Content-Type' => 'application/json']);
    }
    
    public function removeField($index)
    {
        unset($this->jsonData[$index]);
        $this->jsonData = array_values($this->jsonData); // Reindex array
        $this->updateJsonPreview();
    }

    public function updateJsonPreview()
    {
        // Convert array to JSON format
        $jsonObject = [];
        foreach ($this->jsonData as $field) {
            $value = $field['value'];
            switch ($field['type']) {
                case 'number':
                    $value = (int)$value;
                    break;
                case 'boolean':
                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                    break;
            }
            $jsonObject[$field['key']] = $value;
        }
        $this->jsonPreview = json_encode($jsonObject, JSON_PRETTY_PRINT);
    }

    public function render()
    {
        return view('livewire.json-builder');
    }
}