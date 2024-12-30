<div class="{{$width}}">
    <div class="card">
        <div class="card-body">
            <div class="dropdown float-end">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>

            <h4 class="card-title mb-4">Latest Member Ticket Still Available</h4>

            <div class="table-responsive">
                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                    <thead class="table-light">
                        <tr>
                            @foreach($head as $key=>$value)
                            <th>{{$value}}</th>
                            @endforeach
                        </tr>
                    </thead><!-- end thead -->
                    <tbody>
                        @foreach($data as $key => $value)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <h6 class="mb-0">{{$value['name']}}</h6>
                            </td>
                            <td>
                                <div class="font-size-13"><i
                                        class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>{{$value['phone_no']}}
                                </div>
                            </td>
                           
                            <td>
                               {{$value['qty']}}
                            </td>
                            <td><a class="btn btn-info rounded-0" target="_blank" href="{{route('admin.member.detail',['id'=>$value['id']])}}" >SHOW</a></td>
                        </tr>
                        @endforeach
                        <!-- end -->
                    </tbody><!-- end tbody -->
                </table> <!-- end table -->
            </div>
        </div><!-- end card -->
    </div><!-- end card -->
</div>