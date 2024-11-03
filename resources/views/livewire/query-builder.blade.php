<div class=" bg-gray-100 min-h-screen">
    
    <!-- Conditions Section -->
    <div class="space-y-4">
        @foreach($conditions as $index => $condition)
            <div class="row items-center space-x-2">
                <div class="col-md-2">
                     <!-- Field Selection -->
                     <select wire:model="conditions.{{ $index }}.method" class="form-select border p-2 rounded">
                        <option value="">Select Method</option>
                      
                            <option value="Rule">Rule</option>
                            <option value="Member">Member</option>
                            <option value="Instructor">Instructor</option>
                            <option value="Package">Package</option>
                            
                            
                            
                      
                    </select>
                </div>
                <div class="col-md-2">
                    <!-- Field Selection -->
                    <select wire:model="conditions.{{ $index }}.field" class="form-select border p-2 rounded">
                        <option value="">Select Field</option>
                        @foreach($fields as $field)
                            <option value="{{ $field }}">{{ ucfirst($field) }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Operator Selection -->
                <div class="col-md-2">
                <select wire:model="conditions.{{ $index }}.operator" class="form-select border p-2 rounded">
                    @foreach($operators as $operator)
                        <option value="{{ $operator }}">{{ $operator }}</option>
                    @endforeach
                </select>
                </div>
                <!-- Value Input -->
                <div class="col-md-2">
                <input type="text" wire:model="conditions.{{ $index }}.value" placeholder="Value" class="form-control border p-2 rounded">
                <!-- Connector Selection -->
</div>
                <div class="col-md-2">
                
                <select wire:model="conditions.{{ $index }}.connector" class="form-select border p-2 rounded">
                    <option value="AND">AND</option>
                    <option value="OR">OR</option>
                </select>
                </div>
                
                <div class="col-md-2">
                <!-- Remove Condition Button -->
                <button wire:click="removeCondition({{ $index }})" class="btn btn-info  px-2 py-1 rounded-0">Remove</button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add Condition Button -->
    <button wire:click="addCondition" class="btn btn-info px-4 py-2 rounded-0 mt-4">Add Condition</button>

    <!-- Execute Query Button -->
    <button wire:click="executeQuery" class="btn btn-info text-white px-4 py-2 rounded-0 mt-4">Execute Query</button>

    <!-- Query Results -->
    @if($result)
        <h3 class="text-lg font-bold mt-4">Results</h3>
        <table class="w-full mt-2 bg-white border border-gray-300">
            <thead>
                <tr>
                    @foreach($fields as $field)
                        <th class="border p-2">{{ ucfirst($field) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($result as $row)
                    <tr>
                        @foreach($fields as $field)
                            <td class="border p-2">{{ $row->$field }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
