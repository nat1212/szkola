@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/list3.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 text-center">
            <h1>Twoje wydarzenia na uczelni:</h1>
        </div>
    </div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row3">
    <div class="col-10">
        <form action="{{ route('events.search') }}" method="GET" class="d-flex align-items-center">
            <input type="text" class="form-control" name="search_name" placeholder="Szukaj po nazwie" value="" autocomplete="off">
            <button type="submit" class="btn btn-primary">Szukaj</button>
        </form>
    </div>
</div>


@foreach ($userEvents as $event)
    
    <div class="row">
        <div class="table-wrapper ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="name1">{{ $event->name }} </th>
                        
                    </tr>
                </thead>
                
         
            <div>
            </table>
            <div class="select-container">
        <select id="mySelect" onchange="if (this.value) window.location.href = this.value;">
            <option value="" disabled selected>Wybierz</option>
            <option value="{{ route('event.edit', $event->id) }}">Edycja</option>
            <option value="{{ route('addMember', $event->id)}}">AM</option>">Dodaj kumpla</option>
            <option value="{{ route('create2', $event->id)}}">Dodaj podwydarzenie</option>
            <option value="delete" data-id="{{ $event->id }}">Usuń wydarzenie</option>
        </select>
    </div>
 
            <div class="des-row">
            <div class="left-content">
            
            <div class="des-row">
                    <p scope="col" class="des " >Data rozpoczęcia wydarzenia:</p>
                    <p scope="col" class="des2 ">{{ $event->date_start }}</p>
            </div>
            <div class="des-row">
                    <p scope="col" class="des" >Data zakończenia wydarzenia:</p>
                    <p scope="col" class="des2" >{{ $event->date_end }}</p>
            </div>
            <div class="des-row">
                    <p scope="col" class="des" >Rozpoczęcie rekrutacji:</p>
                    <p scope="col" class="des2" >{{ $event->date_start_rek }}</p>
            </div>
            <div class="des-row">
                    <p scope="col" class="des" >Zakończenie rekrutacji:</p>
                    <p scope="col" class="des2">{{ $event->date_end_rek }}</p>
            </div>      
            <div class="des-row">
   
                    <p scope="col" class="des" >Status wydarzenia:</p>
                    <p scope="col" class="des2" >{{ $event->status->name }}</p>
            </div>
            <div class="des-row">
                        <p scope="col" class="des">Skrót:</p>
                        <p scope="col" class="des2">{{ $event->location_shortcut }}</p>
                    </div>
            
            </div>
        
                <div class="right-content expandable-content1"style="display:none;">
                           
                
                    <div class="des-row">
                        <p scope="col" class="des5">Nr budynku:</p>
                        <p scope="col" class="des6">{{ $event->no_building }}</p>
                    </div>
                    <div class="des-row">
                        <p scope="col" class="des5">Klasa:</p>
                        <p scope="col" class="des6">{{ $event->no_room }}</p>
                    </div>
                
                    <div class="des-row2">
                        <p scope="col" class="des5">Opis wydarzenia głównego:</p>
                        <p scope="col" class="des22">{{ $event->description }}</p>
                    </div>
                    </div>
             
                </div>
<div class="expandable-content">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col" class="name1">Wydarzenia:</th>
      </tr>
    </thead>
  </table>

  <div class="container">
    <div class="grid">
    @foreach ($results as $result)

    <select id="mySelect" onchange="if (this.value) window.location.href = this.value;">
             <option value="" disabled selected>Wybierz</option>
             <option value="{{ route('event.edit_details', $results->id) }}">Edycja</option>                           
    </select>

      <div class="event-wrapper">
        <div class="event"> 
          <div class="text">
            <p scope="col" class="des7">{{ $result->title }}</p>
            <div class="des-row2">
              <p scope="col" class="des3">Data rozpoczęcia wydarzenia:</p>
              <p scope="col" class="des4">{{ $result->date_start }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Data zakończenia wydarzenia:</p>
              <p scope="col" class="des4">{{ $result->date_end }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Ilość miejsc: {{ $info->number_seats }}</p>
            </div>
            <div class="btn-container">
            @if ($event->info->isNotEmpty())         
              <button class="btn show-sub-events" data-info-id="{{ $results->id }}">Pokaż szczegóły</button>
              @else
              <button class="btn show-sub-events" data-info-id="{{ $results->id }}" disabled>></button>
                    @endif
            </div>
          </div>
  
          <div class="sub-events" style="display:none;">
            <div class="des-row2">
              <p scope="col" class="des3">Imię prowadzącego:</p>
              <p scope="col" class="des4">{{ $result->speaker_first_name }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Nazwisko prowadzącego:</p>
              <p scope="col" class="des4">{{ $result->speaker_last_name }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Opis:</p>
              <p scope="col" class="des4">{{ $result->description }}</p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>


                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-primary expand-button ">Pokaż wydarzenia</button>
                    <button class="btn btn-primary details-button" data-event-id="{{ $event->id }}">Pokaż szczegóły</button>
                </div>
             
            </div>
        </div>
    </div>
    @endforeach

    {{ $events->links() }}
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    function toggleDetails(event) {
      event.preventDefault();
      var button = event.target;
      var eventWrapper = button.closest('.table-wrapper');
      var eventId = eventWrapper.getAttribute('data-event-id');

      if (button.classList.contains('details-button')) {
        var expandableContent1 = eventWrapper.querySelector('.expandable-content1');
        if (expandableContent1) {
          expandableContent1.style.display = expandableContent1.style.display === 'none' ? 'block' : 'none';
          button.textContent = expandableContent1.style.display === 'none' ? 'Pokaż szczegóły' : 'Ukryj szczegóły';

          var desElements = eventWrapper.querySelectorAll('.des');
          var des2Elements = eventWrapper.querySelectorAll('.des2');
          var isDetailsVisible = expandableContent1.style.display !== 'none';

          desElements.forEach(function(element) {
            element.classList.toggle('des-small', isDetailsVisible);
          });

          des2Elements.forEach(function(element) {
            element.classList.toggle('des-small', isDetailsVisible);
          });
        }
      } 
    }

    var detailsButtons = document.querySelectorAll('.details-button');
    detailsButtons.forEach(function(button) {
      button.addEventListener('click', toggleDetails);
    });

    var expandButtons = document.querySelectorAll('.expand-button');
    var expandableContents = document.querySelectorAll('.expandable-content');

    expandButtons.forEach(function(button, index) {
      button.addEventListener('click', function() {
        expandableContents[index].classList.toggle('expanded');
        button.textContent = expandableContents[index].classList.contains('expanded') ? 'Schowaj wydarzenia' : 'Pokaż wydarzenia';

     
        if (!expandableContents[index].classList.contains('expanded')) {
          var subEvents = expandableContents[index].querySelectorAll('.sub-events');
          var showSubEventButtons = expandableContents[index].querySelectorAll('.show-sub-events');
          subEvents.forEach(function(subEvent, subEventIndex) {
            subEvent.style.display = 'none';
            showSubEventButtons[subEventIndex].textContent = 'Pokaż szczegóły';
          });
        }
      });
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    function toggleDetails(event) {
      event.preventDefault();
      var button = event.target;
      var eventWrapper = button.closest('.event');
      var expandableContent = eventWrapper.querySelector('.sub-events');
      
      if (expandableContent) {
        expandableContent.style.display = expandableContent.style.display === 'none' ? 'block' : 'none';
        button.textContent = expandableContent.style.display === 'none' ? 'Pokaż szczegóły' : 'Ukryj szczegóły';
      }
    }

    var detailsButtons = document.querySelectorAll('.show-sub-events');
    detailsButtons.forEach(function(button) {
      button.addEventListener('click', toggleDetails);
    });
  });

 
</script>
@endsection
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        jQuery(function($) {
            $('select').val('');
            $('.details').hide(); // Schowaj wszystkie podwydarzenia (details) na początku

            $('.show-details').click(function() {
                var detailsRow = $(this).closest('tr').next('.details');
                detailsRow.toggle(); // Pokaż/ukryj podwydarzenie po kliknięciu "Show details"
            });

            $('.show-details').each(function() {
                var eventRow = $(this).closest('tr');
                if (!eventRow.next('.details').length) {
                    $(this).prop('disabled', true);
                    $(this).removeClass('show-details'); // Usuń klasę show-details, jeśli brak podwydarzenia
                }
            });
            
            var selectElement = document.getElementById("mySelect");

// Zresetuj wartość do domyślnej po powrocie z trybu edycji lub podglądu
window.addEventListener("pageshow", function(event) {
  var historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
  if (historyTraversal) {
    selectElement.selectedIndex = 0;
  }
});
              // Pobierz element select
  var selectElement = document.getElementById("mySelect");

// Zresetuj wartość do domyślnej po opuszczeniu trybu edycji
selectElement.addEventListener("blur", function() {
  if (selectElement.value === "") {
    selectElement.selectedIndex = 0;
  }
});
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
          
            $('.delete').click(function() {
                var eventId = $(this).data("id");
                $.ajax({
                    method: "DELETE",
                    url: "http://szkola.test/event/" + eventId,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    }
                })
                
                .done(function(response) {
                    alert("Success");
                    window.location.reload();
                })
                .fail(function(response) {
                    alert("Error");
                });
            });
                $('.des').click(function() {
        var eventId = $(this).data("id");
        $.ajax({
            method: "DELETE",
            url: "http://szkola.test/event-details/" + eventId,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            }
        })
        .done(function(response) {
            alert("Success");
            window.location.reload();
        })
        .fail(function(response) {
            alert("Error");
    });
});
        });
    </script>
   
@endsection

