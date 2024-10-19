<div class="scontainer">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <button wire:click="create()" class="btn btn-primary">+</button>

    

    <table id="datatable-buttons" class="table table-striped dt-responsive table-dark nowrap dataTable no-footer dtr-inline ">
        <thead>
            <tr>
                <th>ID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>PhoneNo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($member as $Mem)
            <tr>
                <td>{{ $Mem->id }}</td>
                <td>{{ $Mem->first_name }}</td>
                <td>{{ $Mem->last_name }}</td>
                <td>{{ $Mem->phone_no }}</td>
                <td>
                    <button wire:click="edit_grid({{ $Mem->id }})" id="id_{{ $Mem->id }}_edit" name="{{ $Mem->id }}_edit" class="btn btn-primary">Edit</button>
                    <button wire:click="delete_grid({{ $Mem->id }})" id="id_{{ $Mem->id }}_delete"  name="{{ $Mem->id }}_delete" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('livewire.Component.grid-with-crud.create')
   
</div>
