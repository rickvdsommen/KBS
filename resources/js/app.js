import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import nlLocale from '@fullcalendar/core/locales/nl';
import jQuery from 'jquery';
import moment from 'moment';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
window.$ = jQuery;


const DATEFORMAT = 'YYYY-MM-DD HH:mm:ss'

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        plugins: [timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        locale: nlLocale,
        editable: true,
        selectable: true,
        hiddenDays: [0, 6],
        slotMinTime: '07:00:00', // Start time at 9 AM
        slotMaxTime: '21:00:00', // End time at 5 PM
        
        select: function (arg) {
            var title = prompt('Afspraak naam:');
            var description = prompt('Beschrijving:');
            if (title) {
                $.ajax({
                    url: "http://127.0.0.1:8000/events",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {
                        title: title,
                        description: description,
                        start: moment(arg.start).format(DATEFORMAT),
                        end: moment(arg.end).format(DATEFORMAT) || arg.start,
                        all_day: Number(arg.allDay),
                    },
                    type: "POST",
                    success: function (res) {
                        // calendar.addEvent(res);
                        calendar.refetchEvents();
                    },
                    error: function (res) {
                        console.log(res);
                    }
                });
            }
        },
        eventChange: function(arg) {
            $.ajax({
                url: "http://127.0.0.1:8000/events",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    id: arg.event.id,
                    title: arg.event.title,
                    start: moment(arg.event.start).format(DATEFORMAT),
                    end: arg.event.end ? moment(arg.event.end).format(DATEFORMAT) : moment(arg.event.start).format(DATEFORMAT),
                    all_day: Number(arg.event.allDay),
                },
                type: "PATCH",
                success: function (res) {
                    console.log(res);
                },
                error: function (res) {
                    console.log(res);
                }
            });
        },
        eventDidMount: function(info) {
            let content;
            if(info.event.extendedProps.description){
                content = `Beschrijving: ${info.event.extendedProps.description}`;
            } else {
                content = `Geen beschrijving`;
            }
            
            tippy(info.el, {
                content: content,
                placement: 'top',
                theme: 'light',
            });
        },
        eventSources: '/events', // Endpoint to fetch existing events
        headerToolbar: {
            left: 'prev,today,next',
            center: 'title',
            right: 'timeGridWeek,timeGridDay' // user can switch between the two
        
        },
        
    });
    
    calendar.render();
});
window.addEventListener('resize', function() {
    calendar.updateSize();
});

window.Alpine = Alpine;

Alpine.start();
