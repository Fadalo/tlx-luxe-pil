<div style="width:100px">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <input type="file" wire:model="file" />

        @error('file') <span class="error">{{ $message }}</span> @enderror

        <button >Upload</button>
    </form>
</div>