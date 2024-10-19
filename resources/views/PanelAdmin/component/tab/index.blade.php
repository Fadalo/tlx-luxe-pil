 <!-- Nav tabs -->
 <span class="d-block d-sm-none">
 <ul class="nav nav-tabs" role="tablist" style="display: flex;
    flex-wrap: nowrap;
    justify-content: center;">
    @foreach ($config['relation'] as $key => $value) 
    <li class="nav-item">
        @if ($loop->first)
         <a class="nav-link active" data-bs-toggle="tab" href="#{{ $value['id'] }}" role="tab">
             <span class="d-block d-sm-none">{!! $value['icon'] !!} </span>
             <span class="d-none d-sm-block">{!! $value['icon'] !!} {{ $value['name'] }}</span>
         </a>
        @else
        <a class="nav-link " data-bs-toggle="tab" href="#{{ $value['id'] }}" role="tab">
             <span class="d-block d-sm-none">{!! $value['icon'] !!} </span>
             <span class="d-none d-sm-block">{!! $value['icon'] !!} {{ $value['name'] }}</span>
         </a>
         @endif
     </li>
     @endforeach
 </ul>
</span>
<span class="d-none d-sm-block">
 <ul class="nav nav-tabs" role="tablist" >
    @foreach ($config['relation'] as $key => $value) 
    <li class="nav-item">
        @if ($loop->first)
         <a class="nav-link active" id="tavb_{{ $value['id'] }}" data-bs-toggle="tab" href="#{{ $value['id'] }}" role="tab">
             <span class="d-block d-sm-none">{!! $value['icon'] !!} </span>
             <span class="d-none d-sm-block">{!! $value['icon'] !!} {{ $value['name'] }}</span>
         </a>
        @else
        <a class="nav-link " id="tavb_{{ $value['id'] }}" data-bs-toggle="tab" href="#{{ $value['id'] }}" role="tab">
             <span class="d-block d-sm-none">{!! $value['icon'] !!} </span>
             <span class="d-none d-sm-block">{!! $value['icon'] !!} {{ $value['name'] }}</span>
         </a>
         @endif
     </li>
     @endforeach
 </ul>
</span>
 <!-- Tab panes -->
 <div class="tab-content p-3 text-muted">

    @foreach ($config['relation'] as $key => $value) 
     @if($loop->first)
     <div class="tab-pane active" id="{{$value['id']}}" role="tabpanel">
         <p class="mb-0">
            @include($value['render'])
         </p>
     </div>
     @else
     <div class="tab-pane " id="{{$value['id']}}" role="tabpanel">
         <p class="mb-0">
            @include($value['render'])
         </p>
     </div>
     @endif
     @endforeach
 </div>