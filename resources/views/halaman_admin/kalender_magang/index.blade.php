@extends('layouts.admin.app')

@section('title', 'Kalender Magang')

@section('content')

    <body>
        <div class="container-fluid">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">📅 Kalender Magang Peserta</h4>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    @endsection

    @push('styles')
        <!-- FullCalendar CSS -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
        <style>
            #calendar {
                max-width: 100%;
                margin: 0 auto;
            }
        </style>
    @endpush

    @push('scripts')
        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calendarEl = document.getElementById('calendar');

                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    height: 'auto',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    },
                    locale: 'id',
                    events: '{{ route('kalender.data') }}',
                    eventClick: function(info) {
                        alert('Peserta: ' + info.event.title + '\nPeriode: ' +
                            info.event.start.toLocaleDateString() + ' - ' +
                            info.event.end.toLocaleDateString());
                    }
                });

                calendar.render();
            });
        </script>
    </body>
@endpush
