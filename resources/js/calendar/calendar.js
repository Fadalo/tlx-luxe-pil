import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import rrulePlugin from '@fullcalendar/rrule';



document.addEventListener('DOMContentLoaded', function() {
    
   let eventP  = window.eventP;
   document.getElementById('tavb_my-schedule').addEventListener('shown.bs.tab', function() {
    
    
    console.log(eventP);
    let calendar = '';
    let calendarEl = document.getElementById('full-calendar');
    calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin, timeGridPlugin,rrulePlugin ],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
    },
    //events: eventP,
    });

    calendar.render();

    //alert(eventP);
    setTimeout(function() {
        console.log(eventP);
      //  calendar.removeAllEvents(); 
        //calendar.refetchEvents()
        calendar.addEventSource(eventP); 
        
        calendar.updateSize(); // Update the calendar size when tab is shown
    },1000);
        
   });

   document.addEventListener('refreshCalendar', (event) => {
    eventP = JSON.parse(event.detail[0].event1);
    console.log(eventP);
   /* let calendar = '';
    let calendarEl = document.getElementById('full-calendar');
    console.log()
    calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin,rrulePlugin ],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events:  JSON.parse(event.detail[0].event1),
        });
    calendar.render();
      */   

    });


});
