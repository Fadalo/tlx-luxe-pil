<div>
    <label >Available Instructor At This Time : </label>
    <select class="form-select" type="listbox" style="mb-3">
       
        <option> -- Select -- </option>
        @foreach($listInstructor as $key => $value)
           <option value="{{$value['id']}}">{{$value['first_name']}} {{$value['last_name']}}</option>
        @endforeach
    </select>
    <button class="btn btn-info rounded-0 mt-3">Save</button>
</div>
