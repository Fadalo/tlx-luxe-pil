<div>
    <style>
        .chat-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
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
        }
        .message-bubble {
            background-color: #dcf8c6;
            border-radius: 8px;
            padding: 8px 12px;
            max-width: 75%;
            position: relative;
            align-self: flex-end;
        }
        .message-time {
            font-size: 0.75rem;
            color: #555;
            text-align: right;
            margin-top: 2px;
        }
        .message-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
        .message-input input {
            flex-grow: 1;
            padding: 8px;
            border: none;
            outline: none;
        }
        .message-input button {
            background-color: #25d366;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    
    
    <div class="chat-container">
        <div class="messages">
            @foreach ($messages as $message)
                <div class="message-bubble">
                    <div class="message-text">{{ $message['text'] }}</div>
                    <div class="message-time">{{ $message['timestamp'] }}</div>
                </div>
            @endforeach
        </div>
    
        <form wire:submit.prevent="sendMessage" class="message-input">
            <input type="text" wire:model="newMessage" placeholder="Type a message..." />
            <button type="submit">Send</button>
        </form>
    </div>
    
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', (message, component) => {
            const messagesDiv = document.querySelector('.messages');
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
    });
</script>

