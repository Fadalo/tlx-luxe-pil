<div>
<div  >
    <div class="card">
        <div class="card-body">


            <!-- end row -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Package</label>
                <div class="col-sm-10">
                    <select wire:model="package_variant_id" wire:change="onChangeSelect($event.target.value)"  wire:change="onChangeSelect()" class="form-select" aria-label="Default select example">
                        <option selected="">Open this select menu</option>
                        @foreach($select as $key => $value)
                        <?php 
                            $package = new App\Models\Package\Package;
                            $oPackage =  $package->find($value['package_id']);
                        ?>
                            <option value="{{$value['id']}}">{{$oPackage['name']}} - {{$value['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- end row -->
            <div class="row mb-3">
                <div class="table-responsive">
                    <table class="table table-dark dt-table mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Scheadule Batch</th>
                                <th>Instructor</th>
                                
                                <th>Date</th>
                                <th>Available Qty</th>
                                
                                <th>Package</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key =>$value)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$value['name']}}</td>
                                <?php
                                   // print_r($value);
                                    $insObj = new App\Models\Instructor\Instructor; 
                                    $l = $insObj->find(1);
                                  //  print_r($l->first_name);
                                ?>
                                <td>{{$l->first_name.' '.$l->last_name}}</td>
                                
                                <td><?=date('d',strtotime($value['start_datetime'])).'-'.date('d M-Y',strtotime($value['end_datetime']))?></td>
                                <td>{{$value['qty_book'].'/'.$value['qty_max']}}</td>
                                <td><button wire:click="onBook({{$value['id']}})"  class="btn btn-primary">Book</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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