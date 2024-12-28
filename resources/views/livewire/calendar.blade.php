<div >
    <style>
    #full-calendar a {
        color: black !important;
    }

    .fc-toolbar-title {
        color: black !important;
    }
    </style>
    <div id="full-calendar"></div>

    <div class="modal fade bs-example-modal-center" id="eventDetailModal" tabindex="-1"
        aria-labelledby="eventDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDetailModalLabel">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Title:</strong>
                        </div>
                        <div class="col-md-8 mb-1">
                            <input class="form-control" id="eventTitle" disabled></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Start:</strong>
                        </div>
                        <div class="col-md-8 mb-1">
                            <input class="form-control" id="eventStart" disabled></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>End:</strong>
                        </div>
                        <div class="col-md-8 mb-1">
                            <input class="form-control" id="eventEnd" disabled></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Description:</strong>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" id="eventDescription" disabled></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script >
        window.eventP = @JSON($events);
        window.instuctor_id =  '{{$instructor_id}}';
        // console.log(eventP)
    
        
    </script>
    
@vite(['resources/js/calendar/calendar.js'])
</div>