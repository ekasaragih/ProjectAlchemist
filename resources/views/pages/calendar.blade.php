@section('head')
{{-- <link rel="stylesheet" href="{{ asset('assets/calendar-20/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/Calender/lib/main.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@extends('layouts.navbar.sidebar')
@section('content')
@include('layouts.navbar.topnav', ['title' => 'Calendar'])

<div class="container">

    <div class="card p-4">
        <div class="table-responsive">
            <div id='calendar'></div>
        </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='{{ asset('assets/Calender/lib/main.js') }}'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            let CategoryFilter = document.querySelector("#CategoryFilter");

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                /* initialDate: '2020-09-12',*/
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                select: function (arg) {

                    var title = prompt('Event Title:');

                    if (title) {
                        calendar.addEvent({
                            title: title.include(val),
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })
                    }

                    calendar.unselect()
                },
                eventClick: function (info) {
                    info.jsEvent.preventDefault();
                    var projNum = info.event.url;
                    // window.open(`@Url.Action("DetailCalendar", "Calendar")?projNum=${projNum}`, '_self');
                },
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                // events: {
                //     url: `@Url.Action("findAll", "Calendar")?category=${$('#CategoryFilter').val()}`,
                //     method: "GET",
                //     data: function () {

                //        /* console.log($('#CategoryFilter').val())*/

                //         return $('#CategoryFilter').val();
                //         // add change event listener to CategoryFilter dropdown
                //     }
                // }
            });
            calendar.render();

            
        });
    </script>

<style>
    body {
        padding: 0;
        font-size: 14px;
    }

    #calendar {
        max-width: 1100px;
        margin: 0 auto;
    }
</style>
</div>
@endsection