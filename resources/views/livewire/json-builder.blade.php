<div class="p-4 bg-gray-100 min-h-screen">
    <div class=" p-4 rounded-0 shadow-md">
        <h2 class="text-lg font-bold mb-4">Build JSON Object</h2>

        <!-- JSON Key-Value Fields -->
        @foreach($jsonData as $index => $field)
            <div class="flex space-x-4 mb-2">
                <!-- Key Input -->
                <input type="text" wire:model="jsonData.{{ $index }}.key" placeholder="Key" class=" border p-2 rounded-0 w-1/3" style="background-color:#2d3444;color:white;">
                
                <!-- Value Input -->
                <input type="text" wire:model="jsonData.{{ $index }}.value" placeholder="Value" class=" border p-2 rounded-0 w-1/3" style="background-color:#2d3444;color:white;">
                
                <!-- Data Type Dropdown -->
                <select wire:model="jsonData.{{ $index }}.type" class=" border p-2 rounded-0"  style="background-color:#2d3444;color:white;">
                    <option value="string">String</option>
                    <option value="number">Number</option>
                    <option value="boolean">Boolean</option>
                </select>
                
                <!-- Remove Field Button -->
                <button wire:click="removeField({{ $index }})" class="btn btn-warning px-2 py-1 rounded-0" style="    color: black;
    margin-top: -5px;
    top: -1px;
    height: 38px;">Remove</button>
            </div>
        @endforeach

        <!-- Add Field Button -->
        <button wire:click="addField" class="btn btn-info px-4 py-2 rounded-0 mt-2">Add Field</button>

        <!-- Live JSON Preview -->
        <button wire:click="exportJson" class="btn btn-info px-4 py-2 rounded-0 mt-2">Export JSON</button>

        <h3 class="text-lg font-bold mt-4">JSON Preview</h3>
        <pre class="bg-gray-200 p-4 rounded text-sm">{{ $jsonPreview }}</pre>
    </div>
</div>
