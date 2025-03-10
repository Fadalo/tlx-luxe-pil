<div>
<div  >
    <div class="card">
        <div class="card-body">


            <!-- end row -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Package</label>
                <div class="col-sm-10"> <?php /*wire:change="onChangeSelect($event.target.value)"  wire:change="onChangeSelect()"*/?>
                    <select wire:model="package_variant_id"  class="form-select" aria-label="Default select example">
                        <option value="" selected="">Open this select menu</option>
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
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Instructor</label>
                <div class="col-sm-10"> <?php /*wire:change="onChangeSelect($event.target.value)"  wire:change="onChangeSelect()"*/?>
                    <select wire:model="instructor_id"  class="form-select" aria-label="Default select example">
                        <option value="" selected="">Open this select menu</option>
                        @foreach($selectInstructor as $key => $value)
                      
                            <option value="{{$value['id']}}">{{$value['first_name']}} {{$value['last_name']}} </option>
                        @endforeach
                    </select>
                </div>
                

            </div>
            <!--
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10" style="display: flex">
                    <div class="col-sm-4">
                        <input type="date" wire:model='dStartDate' class="form-control" placeholder=""  
                            required="">
                    </div>
                    <div>&nbsp; S/D &nbsp;</div>
                            <div class="col-sm-4"> 
                        <input type="date" wire:model='dEndDate' class="form-control"  placeholder=""  
                            required="">
                            </div>
                </div>
              
            </div>-->
            <div class="row mb-3">
                <button wire:click='doSearch' class="btn btn-info rounded-0">SEARCH</button>
            </div>

            <!-- end row -->
            <div class="row mb-3">
                <div class="table-responsive">
                    <table class="table table-dark dt-table mb-0">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package </th>
                                <th>Instructor</th>
                              
                                
                                <th>Package</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key =>$value)
                            <tr>
                                <th scope="row">{{($loop->iteration)}}</th>
                                <td>{{$value['name']}}</td>
                                <?php
                                   // print_r($value);
                                    $insObj = new App\Models\Instructor\Instructor; 
                                    $l = $insObj->find($value['instructor_id']);
                                  //  print_r($l->first_name);
                                ?>
                                <td>{{$l->first_name.' '.$l->last_name}}</td>
                                
                              
                                <td><button wire:click="onBook({{$value['id']}},{{$value['package_variant_id']}})"  class="btn btn-primary">Book</button></td>
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
