<?php
 use App\Helpers\H1BHelper;
 $help = new H1BHelper;
?>
<style>
    table > td {
        font-size:11px; !important
    }
    </style>
@if (!empty($data))
<!-- id="state-saving-datatable" -->
<table id="datatable-buttons" class="table table-striped dt-responsive  table-dark  nowrap ">
    <thead>
        <tr>
            @foreach (array_keys($config['meta']) as $key)
            @if ($loop->first)
            <th></th>
            @endif
            <th>{{ $help->CamelCase($key) }}</th> <!-- Display the keys as table headers -->
            
            @endforeach

        </tr>
    </thead>
    <tbody>
        
        @foreach ($config['data'] as $keyMS =>  $memberResource)
        <tr>
          
           
            @foreach ($config['meta'] as $keyMeta => $MetaValue)
            
            @php
                if(isset($memberResource[$keyMeta]))
                {
                    $valueCol = $memberResource[$keyMeta]     ;
                }
               
           @endphp
          
            @if ($loop->first)
            <td class="{{ $loop->odd ? 'odd' : 'even' }}">
                <div class="btn-group me-1 mt-2">
                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Action <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="{{ route('admin.'.$config['route'].'.detail', $memberResource['id']) }}">Detail
                            </a>
                        <a class="dropdown-item" href="{{ route('admin.'.$config['route'].'.edit', $memberResource['id']) }}">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.'.$config['route'].'.delete', $memberResource['id']) }}">Delete</a>
                    </div>
                </div>
            </td>
            @endif
            <td>
                 
            <div class="">        
            @include('PanelAdmin.component.'.$config['meta'][$keyMeta]['type'].'.view')
            </div>
                         
                    
            </td> <!-- Accessing the values -->
            
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>

@endif