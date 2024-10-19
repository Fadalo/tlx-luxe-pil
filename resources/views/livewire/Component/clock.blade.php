<div wire:init="updateDateTime" wire:poll.1000ms="updateDateTime" class="datetime-clock">
    <h6>{{ $currentDateTime }}</h6>
</div>