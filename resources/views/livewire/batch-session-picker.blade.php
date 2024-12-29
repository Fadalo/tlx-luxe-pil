<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <button>Add Session</button>
    <table class="table table-striped">
        <thead>
                <tr>
                    <td>No</td>
                    <td>Session</td>
                    <td>Schedule</td>
                    <td>Action</td>
                </tr>
        </thead>
        <tbody>
            <?php $listSession = [
                '' => []
            ]?>
            @foreach($listSession as $key => $value)
            <?php 
              //dd($value) 
            ?>
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>Session 1</td>
                <td>Schedule</td>
                <td><a target="_blank" " >SHOW</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
