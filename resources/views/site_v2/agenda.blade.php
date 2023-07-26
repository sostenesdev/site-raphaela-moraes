@extends('layouts.site_v2.master')
@section('title', 'Início')
@section('header_content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Agenda</h1>
                        {{-- <p>{{$model->content_preview}}</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
@endsection
@section('content')

<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col col-12">
            <div id='calendar'></div>
        </div>
    </div>

</div>

<div class="modal" id="myModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Modal title</h5>
      </div>
      <div class="modal-body" >
        <p id="description"></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnFechar" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>


<div class="card" id="mamilos" tabindex="-1"></div>


@endsection

@section('javascript')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.8/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>

<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#btnFechar').click(function () {
            $("#myModal").hide();
        });
    });
    //ajax get evento by id
    function getEvento(id) {
        $.ajax({
            url: "{{ route('site.agenda.evento') }}",
            type: "GET",
            data: {
                id: id
            },
            success: function (data) {
                console.log(data);
            
                $('#title').html(data.title);
                $('#description').html(data.description);
                $("#myModal").show();
                /*$('#color').val(data.color);  
                $('#start').val(data.start);)
                $('#end').val(data.end);
                $('#descricao').val(data.descricao);*/
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

</script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
             locale: 'pt-br',
            timeZone: 'UTC',
            //themeSystem: 'bootstrap5',
            headerToolbar: {
                left: '',
                right: 'prev,next',
                center: 'title',
                //right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth' --}}
            },
            weekNumbers: false,
            dayMaxEvents: true, // allow "more" link when too many events

            events: '{{route("site.agenda.eventos")}}',
            //eventColor: '#378006',
             dateClick: function(info) {
                   // alert('a day has been clicked!'+ info.dateStr);
             },
              eventClick: function(info) {
                    getEvento(info.event.id);
                    
             },

            });
            calendar.render();
  });

</script>
@endsection