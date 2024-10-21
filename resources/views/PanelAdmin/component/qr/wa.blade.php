<div class="p-4"  wire:init="updateP" wire:poll.1000ms >
    <style>
        .Device {
            display: flex;
    width: 100%;
    height:150px;
    border: 1px solid;
    background-color: black;
    flex-wrap: wrap;
    text-align: center;
    align-content: center;
    justify-content: center;
        }
        .iconOnline{
            position: relative;
    left: -2px;
    top: 2px;
        }
        </style>
    @if($loading)
        <div class="flex justify-center items-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
        </div>
    @elseif($error)
        <div class="text-red-500 text-center">
            {{ $error }}
            <button 
                wire:click="fetchQrCode"
                class="mt-2 px-4 py-2 bg-blue-500  rounded hover:bg-blue-600"
            >
                Retry
            </button>
        </div>
    @else
        <div class="flex flex-col items-center">
            @if($qrData)
                @if($status=='offline')
                <div >
                <span class="text-white text-center"><h6>SCAN TO LINK TO <i class="ri-whatsapp-line"></i> WHATSAPP</h6></span>
                
                
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
                <img src="{{ $qrData }}" alt="QR Code" class="w-64 h-64">
                </div>
                <div class="text-white text-center p-1">REFRESH IN: {{ $i }}</div><br>
                <div class="d-none">
                <button 
                    wire:click="updateP"
                    class="btn btn-info mt-4 px-4 py-2"
                >update
                </button>
                <button 
                    wire:click="fetchQrCode"
                    class="btn btn-info  mt-4 px-4 py-2"
                >Refresh QR Code
                </button>
</div>
                @elseif($status=='online')
                <div class="w-64 h-64 text-warning Device" ><div class="col-12">DEVICE 1</div><div class="p-10"><i class="ri-record-circle-line  font-size-14 text-success iconOnline"></i>Online</div></div>
                <button 
                    wire:click="logout"
                    class="btn btn-info  mt-4 px-4 py-2 bg-blue-500  rounded hover:bg-blue-600"
                >Logout
                </button>
                @endif
               
                    
            @endif
        </div>
    @endif
    
</div>