@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
    
    @include('PanelAdmin.component.crud.detail')
    
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                
                <?php
                //print_r($config);
                //exit();
                $data = $config['relation'];
                ?>
                @include('PanelAdmin.component.tab.index',$data)
                
            </div>
        </div>
    </div>
</div>

@include('PanelAdmin.Member.component.modal.modalPayment');
<!-- Canvas -->
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="visibility: hidden;" aria-hidden="true">
                                            <div class="offcanvas-header">
                                              <h5 id="offcanvasBottomLabel">Offcanvas Bottom</h5>
                                              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                            <div class="table-responsive">
                        <table class="table table-dark dt-table mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice No</th>
                                    <th>Status</th>
                                    <th>Paid By</th>
                                    <th>Date</th>
                                    <th>Package</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>INV001011</td>
                                    <td>PAID</td>
                                    <td>CASH - Rp 550.000,00</td>
                                    <td>19/09/2024</td>
                                    <td>Private - Single</td>
                                    <td><button class="btn btn-primary">Print</button></td>

                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>INV001012</td>
                                    <td>PAID</td>
                                    <td>BCA -8293019339- Rp 550.000,00</td>
                                    <td>20/10/2024</td>
                                    <td>Private - Duo</td>
                                    <td><button class="btn btn-primary">Print</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>INV001013</td>
                                    <td>PAID</td>
                                    <td>BRI -8293019349- Rp 550.000,00</td>
                                    <td>31/11/2024</td>
                                    <td>Private - Single</td>
                                    <td><button class="btn btn-primary">Print</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                                            </div>
                                        </div>
@endsection
@section('script')





<!-- Calendar init -->
<!-- <script src="assets/js/pages/calendar.init.js"></script>-->

<script>
// Select the container with the ID 'list_by_status_book'
const listByStatusBook = document.querySelector('#list_by_status_book');

// Check if the container exists
if (listByStatusBook) {
    // Get all buttons with the name 'btnPayment' within this container
    const paymentButtons = listByStatusBook.querySelectorAll('button[name="btnPayment"]');

    // Loop through each button and add a click event listener
    paymentButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the data attribute from the button
            const dataValue = this.getAttribute('data');
            $('#modalPayment #spanID').text(dataValue);
            $('#modalPayment').modal('show');
            // Perform your action here, e.g., log the data or send a request
            console.log('Button clicked with data:', dataValue);
        });
    });
}


</script>

@endsection