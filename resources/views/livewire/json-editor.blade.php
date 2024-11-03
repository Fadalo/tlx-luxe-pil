<div>
    <textarea wire:model="jsonData" rows="10" class="w-full border p-2" placeholder="Enter JSON here..."></textarea>

    <div class="mt-3">
        <button wire:click="formatJson" class="bg-blue-500 text-white p-2 rounded">Format JSON</button>
    </div>

    <script>
        window.addEventListener('alert', event => {
            alert(event.detail.message); // Simple alert, could be replaced with better UI
        });
    </script>
</div>
