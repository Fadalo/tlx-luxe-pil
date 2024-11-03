<div>

    <div class="row">
        <div class="col-md-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link mb-2  rounded-0" id="v-pills-create-tab" data-bs-toggle="pill" href="#v-pills-create"
                    role="tab" aria-controls="v-pills-create" aria-selected="false">Create Contract</a>
                <a class="nav-link mb-2 active rounded-0" id="v-pills-list-tab" data-bs-toggle="pill" href="#v-pills-list"
                    role="tab" aria-controls="v-pills-list" aria-selected="true">Listing Contract</a>
            </div>
        </div>
        <div class="col-md-10 p-3" style="border:1px solid #353d55;min-height:300px">
            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                <div class="tab-pane fade " id="v-pills-create" role="tabpanel"
                    aria-labelledby="v-pills-create-tab">
                    <p>
                        @include('livewire.instructor-contract-create')
                    </p>
                </div>
                <div class="tab-pane fade show active" id="v-pills-list" role="tabpanel" aria-labelledby="v-pills-list-tab">
                     
                         @include('livewire.instructor-contract-list')
                    
                </div>

            </div>
        </div>
    </div>


</div>