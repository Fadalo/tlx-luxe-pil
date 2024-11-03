<?php

namespace App\Livewire;

use Livewire\Component;

class JsonEditor extends Component
{ public $jsonData = '';

    public function formatJson()
    {
        // Try to decode and re-encode JSON data to format it
        try {
            $decoded = json_decode($this->jsonData, true);
            $this->jsonData = json_encode($decoded, JSON_PRETTY_PRINT);
            $this->dispatch('alert', ['type' => 'success', 'message' => 'JSON formatted!']);
        } catch (\Exception $e) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Invalid JSON format.']);
        }
    }

    public function render()
    {
        return view('livewire.json-editor');
    }
}
