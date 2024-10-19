 <!-- Nav tabs -->
 <ul class="nav nav-tabs" role="tablist">
    @foreach ($data2 as $key2 => $value2) 
    <?php 
       //print_r($value2);
       // exit();
    ?>
    <li class="nav-item">
       @if($value2['is_actived'] == 'true')
         <a class="nav-link active" data-bs-toggle="tab" href="#{{ $value2['id'] }}" role="tab">
             <span class="d-block d-sm-none"> {{ $value2['name'] }}</span>
             <span class="d-none d-sm-block"> {{ $value2['name'] }}</span>
         </a>
        @else
        <a class="nav-link " data-bs-toggle="tab" href="#{{ $value2['id'] }}" role="tab">
             <span class="d-block d-sm-none">{{ $value2['name'] }}</span>
             <span class="d-none d-sm-block">{{ $value2['name'] }}</span>
         </a>
         @endif
     </li>
     @endforeach
 </ul>

 <!-- Tab panes -->
 <div class="tab-content p-3 text-muted">

    @foreach ($data2 as $key2 => $value2) 
     @if($value2['is_actived'] == 'true')
     <div class="tab-pane active" id="{{$value2['id']}}" role="tabpanel" style="padding:0px 0px 0px 0px !important">
         <p class="mb-0">
            @include($value2['render'])
         </p>
     </div>
     @else
     <div class="tab-pane " id="{{$value2['id']}}" role="tabpanel">
         <p class="mb-0">
            @include($value2['render'])
         </p>
     </div>
     @endif
     @endforeach
 </div>