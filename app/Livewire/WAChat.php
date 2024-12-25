<?php

namespace App\Livewire;
use App\Http\Controllers\WaController;
use App\Models\Watem\Watem;
use Livewire\Component;
use App\Models\Member\Member;
use App\Models\Instructor\Instructor;

use Illuminate\Http\Request;
class WAChat extends Component
{

    public $messages = [];
    public $waType = '';
    public $newMessage = '';
    public $instructor_id = '';
    public $member_id = '';
    public $phone_no = '';
    public $config = [];
    public $rr = [];
    public $templateBatch = [];
    public $selectedTemplete = '';
    public $showEmoji = false;
    protected $listeners = ['emoji2Message'];
    public $memberField = [
        'phone_no',
        'first_name',
        'last_name',
        'birthday',
        'pin',
        'join_date',
        'actived_date',
        'referal_by',
        'is_verify',
        'is_notify',
        'is_news',
        'status_member',
        'status_document',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
    public $instructorField = [
        'phone_no',
        'first_name',
        'last_name',
        'birthday',
        'pin',
        'join_date',
        'actived_date',
        'status',
        'is_verify',
        'is_notify',
        'status_document',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
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
      //  return false;
    }
    public function emoji2Message($param)
    {
       // dd($this->newMessage);
        $this->newMessage = $this->newMessage . $param['emoticon'];
    }
    public function mount(){
       

        if($this->waType == 'Member')
        {
            $Member = Member::find($this->member_id);
            $this->phone_no = str_replace('-','',str_replace(' ','',str_replace('+','',$Member->phone_no)));
        }
        else if ($this->waType == 'Instructor'){
            $Instructor = Instructor::find($this->instructor_id);
            $this->phone_no = str_replace('-','',str_replace(' ','',str_replace('+','',$Instructor->phone_no)));
        }
        //dd($this->phone_no);
        $this->historyMessage();
        $this->getTemplete();
    }

    public function getTemplete(){
        $this->templateBatch = Watem::where('module',$this->waType)->get()->toArray();
        //dd($this->templateBatch );

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
       
    }
    public function doShowEmojiBox()
    {
        if ($this->showEmoji)
        {
            $this->showEmoji = false;
        }
        else
        {
            $this->showEmoji = true;
        }
       
    }
    public function doSendTemplete(){

        $id_temp = $this->selectedTemplete;
        if ($id_temp != ''){
            $msg = Watem::find($id_temp);
            if($this->waType == 'Member'){

                $member = Member::where('phone_no','like','%'.$this->phone_no.'%')->first();
                $templete = $msg->templete;
               
                foreach($this->memberField as $value)
                {
                    $field = '{$Member->'.$value.'}';
                    $templete = str_replace($field,$member[$value],$templete);
                }
            
                $waC = new WaController;
                $waC->doSendMessage($this->phone_no,$templete);
            }else{

                $instructor = Instructor::where('phone_no','like','%'.$this->phone_no.'%')->first();
                $templete = $msg->templete;
               
                foreach($this->instructorField as $value)
                {
                    $field = '{$Instructor->'.$value.'}';
                    $templete = str_replace($field,$instructor[$value],$templete);
                }
            
                $waC = new WaController;
                $waC->doSendMessage($this->phone_no,$templete);
            }
          
        }
      
    }

    public function render()
    {
        return view('livewire.wa-chat');
    }
}
