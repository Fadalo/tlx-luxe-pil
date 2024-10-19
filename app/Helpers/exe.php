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
            <td width="5%" class="{{ $loop->odd ? 'odd' : 'even' }}">
                <div class="btn-group me-1 mt-2">
                    <button class="btn btn-info rounded-0 btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Action <i class="mdi mdi-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu rounded-0" style="">
                        <a class="dropdown-item" href="{{ route('admin.'.strtolower($config['route']).'.detail', $memberResource['id']) }}">Detail
                            </a>
                        <a class="dropdown-item" href="{{ route('admin.'.strtolower($config['route']).'.edit', $memberResource['id']) }}">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('admin.'.strtolower($config['route']).'.delete', $memberResource['id']) }}">Delete</a>
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



        // href="{{ route('admin.'.strtolower($route).'.delete', $member['id']) }}"