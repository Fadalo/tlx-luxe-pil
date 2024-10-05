 <!-- Nav tabs -->
 <ul class="nav nav-tabs" role="tablist">
     <li class="nav-item">
         <a class="nav-link active" data-bs-toggle="tab" href="#my-package" role="tab">
             <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
             <span class="d-none d-sm-block">My Package</span>
         </a>
     </li>
     <li class="nav-item">
         <a class="nav-link" data-bs-toggle="tab" href="#my-scheadule" role="tab">
             <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
             <span class="d-none d-sm-block">Scheadule</span>
         </a>
     </li>

     <li class="nav-item">
         <a class="nav-link" data-bs-toggle="tab" href="#my-invoice" role="tab">
             <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
             <span class="d-none d-sm-block">History Payment</span>
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

     <div class="tab-pane active" id="my-package" role="tabpanel">
         <p class="mb-0">
            <livewire:InlineGridCreate />
         </p>
     </div>
     <div class="tab-pane" id="my-scheadule" role="tabpanel">
         <p class="mb-0">
             @include('PanelAdmin.component.calendar.index')
         </p>
     </div>
     <div class="tab-pane" id="my-invoice" role="tabpanel">
         <p class="mb-0">
         <div class="table-responsive">
             <table  class="table table-dark dt-table mb-0">

                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Invoice No</th>
                         <th>Date</th>
                         <th>Package</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <th scope="row">1</th>
                         <td>Mark</td>
                         <td>Otto</td>
                         <td>@mdo</td>
                     </tr>
                     <tr>
                         <th scope="row">2</th>
                         <td>Jacob</td>
                         <td>Thornton</td>
                         <td>@fat</td>
                     </tr>
                     <tr>
                         <th scope="row">3</th>
                         <td>Larry</td>
                         <td>the Bird</td>
                         <td>@twitter</td>
                     </tr>
                 </tbody>
             </table>
         </div>
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