<div class="p-4"  wire:init="updateP" wire:poll.1000ms >
    
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
                <span class="text-white">{{ $i }}</span>
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
                <img src="{{ $qrData }}" alt="QR Code" class="w-64 h-64">
                </div>
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
                @elseif($status=='online')
                <div class="w-64 h-64 text-warning" >Device 1: <br>Online</div>
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