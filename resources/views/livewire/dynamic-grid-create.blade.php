<div>
    <style>
    #datatable-buttons td {
        padding: 0px;
    }
    </style>
    <a class="waves-effect" wire:click="increment" style="color:white;position:absolute;top:30px;right:25px"><i
            class="ri-file-add-line"></i> Add Variant</a>

    <!-- Alert Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit.prevent="saveData">
        <table id="datatable-buttons" class="table table-hover table-dark mb-0" style="width:100%">
            <thead>
                <tr>
                    @foreach($head as $key=>$row)
                    <th class="{{ $row['width']}}"> {{ $row['name'] }} </th>
                    @endforeach
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $packageId = $config['data'][0]['id'];
                @endphp
                @foreach($data as $keyRow => $rows)

                @php
                $packageVariantId = $rows[0]['value'];
                @endphp
                <tr>
                    @foreach($rows as $keyCol => $col)
                   
                    @if($loop->first)
                    <td >
                    @else
                    <td>
                    @endif

                        @switch($col['type'])
                        @case('text')
                        @if($rows[0]['source']== 'db')
                        <input class="form-control rounded-0 " type="{{$col['type']}}" style="height:61px;"
                            wire:model.lazy="data.{{$keyRow}}.1.value"
                            wire:change="updateField({{ $keyRow }},{{ $packageId  }}, {{$packageVariantId}} ,'name', $event.target.value)"
                            value="{{$col['value']}}" />
                        @else
                        <input class="form-control rounded-0 " type="{{$col['type']}}" style="height:61px;"
                            wire:model.lazy="data.{{$keyRow}}.1.value"
                            wire:change="updateField({{ $keyRow }},{{ $packageId  }}, 'n' ,'name', $event.target.value)"
                            value="{{$col['value']}}" />
                        @endif
                        @break

                        @case('textarea')
                        @if($rows[0]['source']== 'db')
                        <textarea class="form-control rounded-0 " wire:model.lazy="data.{{$keyRow}}.2.value" style="height:61px;"
                            wire:change="updateField({{ $keyRow }},{{ $packageId  }}, {{$packageVariantId}}  ,'desc', $event.target.value)">
                            {{$col['value']}}</textarea>
                        @else
                        <textarea class="form-control rounded-0" wire:model.lazy="data.{{$keyRow}}.2.value" style="height:61px;"
                            wire:change="updateField({{ $keyRow }},{{ $packageId  }}, 'n' ,'desc', $event.target.value)" />

                        {{$col['value']}}</textarea>
                        @endif
                        @break

                        @case('number')
                        @if($rows[0]['source']== 'db')
                        <input class="form-control rounded-0 " style="height:61px;" type="{{$col['type']}}" 
                            wire:model.lazy="data.{{$keyRow}}.{{$keyCol}}.value"
                            wire:change="updateField({{ $keyRow }},{{ $packageId  }}, {{$packageVariantId}} ,'{{$col['field']}}', $event.target.value)"
                            value="{{$col['value']}}" />
                        @else
                        <input class="form-control rounded-0 " style="height:61px;" type="{{$col['type']}}"
                            wire:model.lazy="data.{{$keyRow}}.{{$keyCol}}.value"
                            wire:change="updateField({{ $keyRow }},{{ $packageId  }}, 'n' ,'{{$col['field']}}'', $event.target.value)"
                            value="{{$col['value']}}" />
                        @endif
                        @break

                        @default
                        <span style="top: 20px;
    
    position: relative;
    text-align: center;">{{($keyRow + 1)}}</span>
                        @endswitch

                    </td>
                    @if($loop->last)
                    <td >
                        <div>
                            @if($rows[0]['source']== 'db')

                            <div class="btn-group me-1 mt-2">
                                <button class="btn btn-info rounded-0 btn-sm dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Action <i class="mdi mdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu rounded-0" style="">
                                    
                                    <a  wire:click="createRule({{$rows[0]['value']}})" class="dropdown-item" >Rule</a>
                                    <div class="dropdown-divider"></div>
                                    <form name="">
                                        <a wire:click="decrease({{ $keyRow }},{{$rows[0]['value']}})"
                                            class="dropdown-item" name="btnDelete" data-id="">Delete</a>
                                    </form>
                                </div>
                            </div>

                            @else
                            <a wire:click="decrease({{ $keyRow }},'n')" style="position: relative;
    top: 20px;"><i class=" ri-delete-bin-6-line"></i></a>
                            @endif
                        </div>
                    </td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>