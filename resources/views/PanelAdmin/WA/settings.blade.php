@extends('PanelAdmin.blank')
@section('meta_title',$config['page']['title'])
@section('meta_description',$config['page']['description'])
@section('meta_author',$config['page']['author'])
@section('page-name',$config['page']['name'])
@section('page-parent',$config['page']['parent'])

@section('head-page')

@endsection
@section('content')
<div class="row">
    <div class="col-12">

<div class="row">
    <div class="col-4">
        <div class="card">
           
            <div class="card-body">
                @livewire('WaQrCode')
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-title p-3"><h6>Test Sending</h6></div>
            <div class="card-body">
                <form action="{{ route('admin.wa.sendMessage')}}" method="post" id="formSendMessage">
                @csrf
                <div class="mb-3">
                    <label for="phone_no" class="form-label">No HP</label>
                    <input type="text" class="form-control"  autocomplete="off" id="phone_no" name="phone_no" placeholder=""  
                        required="">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea type="text" class="form-control"  autocomplete="off" id="message" name="message" placeholder=""  
                        required="">
</textarea>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div>
                        <button name="btnSend" class="btn btn-success rounded-0" type="submit">Send</button>
                        <button name="btnClear" class="btn btn-success rounded-0" type="submit">Clear</button>
                        
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function () {
    // Add click event listener to the document
    const btnSend = document.querySelector('#formSendMessage button[name="btnSend"]');
    const saveClear  = document.querySelector('#formSendMessage button[name="btnClear"]');
    // Optional: Add an event listener to the button
    btnSend.addEventListener('click', function(event) {
         // Prevent form submission for demonstration
        ajaxable('#formSendMessage').onStart(function(params) {
            // Make stuff before each request, eg. start 'loading animation'
            console.log('hello');
        })
        .onEnd(function(params) {
            // Make stuff after each request, eg. stop 'loading animation'
            console.log('selesai');
        })
        .onResponse(function(res, params) {
            // Make stuff after on response of each request
            
            var result = JSON.parse(params.req.response);
            console.log(result);
            Swal.fire({
                title: 'Success',
                text: 'success send message',
                icon: 'success',
                confirmButtonText: 'OK'
            });
           // alert(result.message);
            //console.log(result);
        })
        .onError(function(err, params) {
            // Make stuff on errors
            //console.log(err);
        });
        //event.preventDefault();
    });

    saveClear.addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('formSendMessage').reset();
    });

});
</script>
@endsection