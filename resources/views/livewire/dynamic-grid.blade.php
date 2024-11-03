<div style="text-align: center;width:100%">
    <?php
   // dd($isPageShow);
    ?>
    @if($isPageShow['CreatePackageVariant'])
         
          @include('livewire.dynamic-grid-create')
    @elseif($isPageShow['CreateRule'])
    
          @include('livewire.dynamic-grid-rule-create')
    
  
    @endif
    <script>
    window.addEventListener('swal:alert', event => {
        
     //   console.log(event.detail[0]); 
        Swal.fire({
            icon: event.detail[0].icon,
            title: event.detail[0].title,
            text: event.detail[0].text,
        });
    });
</script>
</div>