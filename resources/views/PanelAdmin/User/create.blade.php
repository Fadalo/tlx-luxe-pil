@extends('PanelAdmin.blank')
@section('meta_title','Instructor - Create')
@section('meta_description','Description Instructor')
@section('meta_author','Telcomixo')
@section('page-name','Create Instructor')
@section('page-parent','Instructor')

@section('head-page')

@endsection

@section('content')



<div class="row">
    <div class="col-6">
    <div class="card">
    <div class="card-body"><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Home</span>    
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Profile</span>    
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                    <span class="d-none d-sm-block">Messages</span>    
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                                    <span class="d-none d-sm-block">Settings</span>    
                                                </a>
                                            </li>
                                        </ul>
        
                                        <!-- Tab panes -->
                                        <div class="tab-content p-3 text-muted">
                                            <div class="tab-pane active" id="home" role="tabpanel">
                                                <p class="mb-0">
                                                    Raw denim you probably haven't heard of them jean shorts Austin.
                                                    Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                                    cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                                    butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                                    qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                                    iphone. Seitan aliquip quis cardigan american apparel, butcher
                                                    voluptate nisi qui.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="profile" role="tabpanel">
                                                <p class="mb-0">
                                                    Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                                    single-origin coffee squid. Exercitation +1 labore velit, blog
                                                    sartorial PBR leggings next level wes anderson artisan four loko
                                                    farm-to-table craft beer twee. Qui photo booth letterpress,
                                                    commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                                    vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                                    aesthetic magna delectus.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="messages" role="tabpanel">
                                                <p class="mb-0">
                                                    Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                                    sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                                    farm-to-table readymade. Messenger bag gentrify pitchfork
                                                    tattooed craft beer, iphone skateboard locavore carles etsy
                                                    salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                                    Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                                    mi whatever gluten yr.
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="settings" role="tabpanel">
                                                <p class="mb-0">
                                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                                    art party before they sold out master cleanse gluten-free squid
                                                    scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                                    art party locavore wolf cliche high life echo park Austin. Cred
                                                    vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                                    farm-to-table VHS.
                                                </p>
                                            </div>
                                        </div>
</div>
</div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Form Member</h4>
                <p class="card-title-desc"><div class="alert alert-warning"><i class=" fas fa-info-circle" ></i>&nbsp;Form ini digunakan untuk mengisi data anggota baru. </div>
                </p>
                <form class="needs-validation" novalidate="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">First name</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="First name"
                                    value="" required="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom02" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Last name"
                                    value="" required="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom03" class="form-label">Email</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="exp-test@gmail.com"
                                    value="" required="">

                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="validationCustom03" class="form-label">Phone No</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="exp-082177522260"
                                    value="" required="">

                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-12">
                                <label for="validationCustom03" class="form-label">Address</label>
                                <textarea type="text" class="form-control" id="validationCustom02" placeholder="Address"
                                    value="Otto" required="">
</textarea>
                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">&nbsp;
</div></div>
                    
                    <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection