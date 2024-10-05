
<div style="text-align: center;width:100%">
    <button wire:click="increment">+</button>
   {{ $ids }}
    <table id="datatable-buttons" style="width:100%" >
        <thead>
            <tr >
            @foreach($head as $key=>$row)
              <th style="color:white;background-color:grey;width:10%"> {{ $row['name'] }} </th>
            @endforeach
               <th></th> 
            </tr>
        </thead>
        <tbody>
            @foreach($data as $rows)
            <tr>
            @foreach($rows as $keyCol => $col)
            <td style="padding:2px !important">
             @if($col['type']  == 'text')
                @include('PanelAdmin.component.text.create',$col)
             @elseif ($col['type']  == 'dropdown') 
                @include('PanelAdmin.component.dropdown.create',$col)
             @endif  
            

            </td>
            @if($loop->last)
            <td>
                 <button class="btn btn-primary" wire:click="decrease({{ $loop->iteration }})">-</button>
            </td>
            @endif
             @endforeach
</tr>
            @endforeach
        </tbody>
    </table>
</div>