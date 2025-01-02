<div>
    <label >Available Instructor At This Time : </label>
    <select wire:model='selected_instructor' class="form-select" type="listbox" style="mb-3">
       
        <option value=""> -- Select -- </option>
        @foreach($listInstructor as $key => $value)
           <option value="{{$value['id']}}">{{$value['instructor_name']}}</option>
        @endforeach
    </select>
    <button wire:click='doSave' class="btn btn-info rounded-0 mt-3">Save</button>
</div>
