import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import rrulePlugin from '@fullcalendar/rrule';

let calendar = '';
let calendarEl = document.getElementById('full-calendar');

document.addEventListener('DOMContentLoaded', function() {
    
    calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, timeGridPlugin,rrulePlugin ],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
    },
    events: eventP,
    });

    calendar.render();

   document.getElementById('tavb_my-schedule').addEventListener('shown.bs.tab', function() {
      
    //alert(eventP);
        console.log(eventP);
        //calendar.removeAllEvents(); 
        calendar.addEventSource(eventP); 
        
        calendar.updateSize(); // Update the calendar size when tab is shown
        
   });

   document.addEventListener('refreshCalendar', (event) => {
   
        console.log(event.detail[0].event1);
           calendar.removeAllEvents(); // Clear events
           calendar.addEventSource(event.detail[0].event1); // Add updated events
          // calendar.render();
           calendar.updateSize(); 
    });

});
