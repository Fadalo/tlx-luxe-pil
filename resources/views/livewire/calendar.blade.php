<div>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Livewire is loaded!');
        var calendarEl = document.getElementById('full-calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
        left: 'today prev,next',
        center: 'title',
        right: 'timeGridWeek,dayGridMonth'
      },
            events: @json($events), // Load events from Livewire

            // Capture event clicks or interactions
            /*
            dateClick: function(info) {
                var eventTitle = prompt('Enter event title:');
                if (eventTitle) {
                    // Emit event to Livewire to add
                    Livewire.emit('addEvent', {
                        title: eventTitle,
                        start: info.dateStr
                    });
                }
            },*/
            eventClick: function(info) {
                // Prevent the default browser action (optional)
                info.jsEvent.preventDefault();

                const options = {
                    day: '2-digit',
                    month: 'long', // Full month name
                    year: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true, // AM/PM format
                };
                // Display event details in the modal
                document.getElementById('eventTitle').value = info.event.title;
                document.getElementById('eventStart').value = new Date(info.event.start
                    .toISOString()).toLocaleString('en-EN', options);
                document.getElementById('eventEnd').value = new Date(info.event.end
                    .toISOString()).toLocaleString('en-EN', options);
                document.getElementById('eventDescription').textContent = info.event.extendedProps
                    .description || 'No description available.';

                // Show the Bootstrap modal
                var myModal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
                myModal.show();
            },
        });

        calendar.render();

        document.getElementById('tavb_my-scheadule').addEventListener('shown.bs.tab', function() {
            calendar.updateSize(); // Update the calendar size when tab is shown
        });
        // Listen for Livewire event to re-render calendar
        Livewire.on('refreshCalendar', () => {
            calendar.removeAllEvents(); // Clear events
            calendar.addEventSource(@json($events)); // Add updated events
        });
    });
    </script>
</div>