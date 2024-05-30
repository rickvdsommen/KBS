import './bootstrap';

import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import nlLocale from '@fullcalendar/core/locales/nl';

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        plugins: [timeGridPlugin, interactionPlugin],
        initialView: 'timeGridWeek',
        locale: nlLocale,
        editable: true,
        selectable: true,
        select: handleDateSelect,
        // events: '/events' // Endpoint to fetch existing events
    });
    calendar.render();

    function handleDateSelect(arg) {
        const title = prompt('Enter a title for the event:');
        if (title) {
            const eventData = {
                title: title,
                start_time: arg.start.toISOString(),
                finish_time: arg.end.toISOString(),
            };

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/agenda');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function() {
                if (xhr.status === 201) {
                    const appointment = JSON.parse(xhr.responseText);
                    calendar.addEvent({
                        title: appointment.title,
                        start: appointment.start_time,
                        end: appointment.finish_time
                    });
                } else {
                    console.error('Request failed. Status:', xhr.status);
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            xhr.send(JSON.stringify(eventData));
        }
        calendar.unselect();
    }
});

window.Alpine = Alpine;

Alpine.start();
