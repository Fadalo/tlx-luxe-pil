<?php

namespace App\Livewire;
use App\Http\Controllers\WaController;
use Livewire\Component;

use Illuminate\Http\Request;
class WAChat extends Component
{

    public $messages = [];
    public $newMessage;
    public $instuctor_id = '';
    public $phone_no = '6282177522260';
    public $config = [];
    public $rr = [];
    public function sendMessage(Request $request)
    {
        $this->validate(['newMessage' => 'required']);
        $this->messages[] = [
            'text' => $this->newMessage,
            'timestamp' => now()->format('H:i')
        ];

        $phone_no =  str_replace(' ','',str_replace('-','',str_replace('@c.us','',$this->phone_no)));

        $waC = new WaController;
        $waC->doSendMessage($phone_no,$this->newMessage);
        $this->newMessage = '';
        $this->historyMessage();
    }
    
    public function mount(){
        $this->historyMessage();
    }

    public function historyMessage(){
        $phone_no = $this->phone_no;
        $waC = new WaController;
        $result = (array) ($waC->doGetMessageHistory($phone_no));
      
        $a = $result;
        
       // $this->rr = (json_encode($result['original']['data']['messages'],true));
       if($result['original']['success']== 1)
       {
            $this->messages = ($result['original']['data']['messages']);
       }
       // 
    }

    public function render()
    {
        return view('livewire.wa-chat');
    }
}
