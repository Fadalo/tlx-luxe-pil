<div>
    {{-- Be like water. --}}
    <table class="table table-striped">
        <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Phone No</td>
                    <td>Link</td>
                </tr>
        </thead>
        <tbody>
            @foreach($listMember as $key => $value)
            <?php 
              //dd($value) 
            ?>
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$value['first_name']}} {{$value['last_name']}} </td>
                <td>{{$value['phone_no']}}</td>
                <td><a target="_blank" href="{{route('admin.member.detail',['id'=>$value['id']])  }}" >SHOW</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
