<div wire:init="updateDateTime" wire:poll.10000000ms="updateDateTime" class="datetime-clock">
    <h6>{{ $currentDateTime }}</h6>
</div>