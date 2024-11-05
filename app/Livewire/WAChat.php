<?php

namespace App\Livewire;

use Livewire\Component;

class WAChat extends Component
{

    public $messages = [];
    public $newMessage;

    public function sendMessage()
    {
        $this->validate(['newMessage' => 'required']);
        $this->messages[] = [
            'text' => $this->newMessage,
            'timestamp' => now()->format('H:i')
        ];
        $this->newMessage = '';
    }

   
    public function render()
    {
        return view('livewire.wa-chat');
    }
}
