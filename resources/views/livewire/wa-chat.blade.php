<div><div wire:poll.5000ms="historyMessage" >
    <style>
        .chat-container {
            max-width: 100%;
            margin: auto;
            border: 1px solid #303749;
            background-image: url('{{env('BASE_URL_ADMIN')}}/images/background-wa.jpg');
            display: flex;
            flex-direction: column;
            height: 80vh;
        }
        .messages {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
            color:rgb(90, 84, 84);
        }
        .message-text{
            font-size:0.9em;
        }
        .message-bubble {
            background-color: #32ae6c;
            border-radius: 8px;
            padding: 8px 12px;
            
            max-width: 300px;
            position: relative;
            align-self: flex-end;
        }
        .message-bubble_left {
            background-color: #dcf8c6;
            border-radius: 8px;
            padding: 8px 12px;
            max-width: 330px;
            position: relative;
            align-self: flex-start;
        }
        .message-time {
            font-size: 0.55rem;
            color: #555;
            text-align: right;
            margin-top: 2px;
        }
        .message-input {
            display: flex;
            /*padding: 10px;*/
            border-top: 1px solid #ddd;
        }
        .message-input input {
            flex-grow: 1;
            padding: 8px;
            border: none;
            outline: none;
        }
        .emoji-st{
            position: absolute;
             z-index: 99;
            bottom: 139px;
             left: 48px;
        }
    </style>
    
    <!-- class="chat-container" -->
    <div  class="chat-container">
        <div class="messages">
          
            
            @foreach ($messages as $message)
         
                <?php
                 //  dd($message);
                    if($this->waType == 'Member')
                    {
                        $om = new App\Models\Member\Member;
                        $fullName = str_replace('@c.us','',$message['from']);
                        $Member =  $om->where('phone_no','+'.str_replace('@c.us','',$message['from']))->first();
                    // dd();
                        if ($Member){
                        $fullName = $Member['first_name'] .' '.$Member['last_name'];
                        }
                    } else {
                        $oI = new App\Models\Instructor\Instructor;
                        $fullName = str_replace('@c.us','',$message['from']);
                        $Instructor =  $oI->where('phone_no','+'.str_replace('@c.us','',$message['from']))->first();
                    // dd();
                        if ($Instructor){
                        $fullName = $Instructor['first_name'] .' '.$Instructor['last_name'];
                        }
                    }

                  //  print_r($message);
                    
                ?>
                
                @if($message['from'] == $phone_no.'@c.us')
                 <?php
                   // print_r('<pre>');
                   // print_r( $message);
                   // print_r( $message['hasMedia'])
                 ?>
                <div class="message-bubble_left ">
                    <div class="message-text"><h6 style="color:#555;font-size:1em;text-decoration:underline">{{ $fullName }}</h6></div>
                    @if(!empty($message['hasMedia']))
                    <div class="message-text"><img width="250px" src="{{ $message['imageUrl'] }}" /></div>
                    @endif
                    <div class="message-text"><span style="color:#555">{{ $message['body'] }}</span></div>
                    <div class="message-time">{{ date('d/m/Y',$message['timestamp']) }}<br>{{ date('H:i:s',$message['timestamp']) }}</div>
                </div>
                @else
                <div class="message-bubble">
                    <div class="message-text"><h6 style="color:#555;font-size:1em;text-decoration:underline">{{ $fullName }}</h6></div>
                    @if(!empty($message['hasMedia']))
                    <div class="message-text"><img width="250px" src="{{ $message['imageUrl'] }}" /></div>
                    @endif
                    <div class="message-text"><span style="color:#555">{{ $message['body'] }}<span></div>
                    <div class="message-time">{{ date('d/m/Y',$message['timestamp']) }}<br>{{ date('H:i:s',$message['timestamp']) }}</div>
                </div>
                @endif
                
            @endforeach
        </div>
        
        <div class="emoji-st" style="@if($showEmoji) display:block @else display:none @endif">
            <emoji-picker id="emoji-picker"></emoji-picker>
        </div>
        <div style="@if($showFileUpload) display:block @else display:none @endif">
        <livewire:FileUpload />
        </div>
        <form wire:submit.prevent="sendMessage" class="message-input">
            
            <a class="btn btn-info rounded-0" wire:click='doShowFileUploadBox' ><span style="
    position: absolute;
    left: 42px;
"><i class=" ri-attachment-2"></i></span></a>
<a class="btn btn-warning rounded-0" wire:click='doShowEmojiBox' ><span style="
  
    position: absolute;
    left: 67px;

"><i class=" ri-emotion-happy-line"></i></span></a>
            <input class="form-control rounded-0" type="text" wire:model="newMessage" placeholder="Type a message..." />
            <button class="btn btn-info rounded-0" wire:click.prevent='sendMessage' type="submit">Send</button>
        </form>
    </div>
   
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>

<div class="row">
    <div class="col-md-12" style="display:flex">
        <select class="form-select col-md-8" style="width:80% !important" wire:model='selectedTemplete' >
            <option value=""  selected>-- Select Templete --</option>
            @foreach($templateBatch as $key => $value)
                <option value="{{$value['id']}}" >{{$value['name']}}</option>
            @endforeach
        </select>
        <button class="btn btn-info rounded-0 col-md-4"  style="width:20% !important" wire:click='doSendTemplete'>Send Templete</button>
    </div>
</div>
</div>



<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            const messagesDiv = document.querySelector('.messages');
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
    const emojiPicker = document.getElementById('emoji-picker');
   // console.log(emojiPicker);
    if (emojiPicker) {
        emojiPicker.addEventListener('emoji-click', event => {
            console.log(event.detail);
            //console.log('aaaaa');
            Livewire.dispatch('emoji2Message',[{'emoticon':event.detail.unicode}]);
        });
    }
});
</script>
<?php
/*

document.addEventListener('DOMContentLoaded', function() {
    const emojiPicker = document.getElementById('emoji-picker');
    //console.log(emojiPicker);
    if (emojiPicker) {
        emojiPicker.addEventListener('emoji-click', event => {
            console.log(event.detail.unicode);
        //    console.log('aaaaa');
             livewire:dispatch('emoji2Message',{'emoticon':event.detail.unicode})
        });
    }
});
*/
?>
