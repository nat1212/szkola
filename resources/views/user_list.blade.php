@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/list3.css')}}">
<link rel="stylesheet" href="{{asset('css/footer.css')}}">
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
           
 
            <div class="des-row">
            <div class="right-content">
            <div class="des-row">
            
            </div>
            <div class="des-row">
                    <p scope="col" class="des " >Data rozpoczęcia wydarzenia:</p>
                    <p scope="col" class="des2 ">{{$event->date_start->format('Y-m-d') }} {{ $event->date_start->format('H:i') }}</p>
            </div>
            <div class="des-row">
                    <p scope="col" class="des" >Data zakończenia wydarzenia:</p>
                    <p scope="col" class="des2" >{{ $event->date_end->format('Y-m-d') }} {{ $event->date_end->format('H:i') }}</p>
            </div>
           <div class="des-row">
                    <p scope="col" class="des" >Rozpoczęcie publikacji:</p>
                    <p scope="col" class="des2" >{{$event->date_start_publi->format('Y-m-d') }} {{$event->date_start_publi->format('H:i') }}</p>
            </div>
            <div class="des-row">
                    <p scope="col" class="des" >Zakończenie publikacji:</p>
                    <p scope="col" class="des2">{{$event->date_end_publi->format('Y-m-d') }} {{$event->date_end_publi->format('H:i') }}</p>
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
   
    @foreach ($event->info as $info)

 

      <div class="event-wrapper" data-description="{{ $info->description }}">
        <div class="event"> 
          <div class="text">
            <p scope="col" class="des7"> {{$info->title }}</p>
            <div class="des-row2">
              <p scope="col" class="des3">Prowadzący:</p>
              <p scope="col" class="des4">{{ $info->speaker_first_name }} {{ $info->speaker_last_name }}</p>

            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Data rozpoczęcia wydarzenia:</p>
              <p scope="col" class="des4"> {{ $info->date_start->format('Y-m-d') }} {{  $info->date_start->format('H:i') }} </p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Data zakończenia wydarzenia:</p>
              <p scope="col" class="des4"> {{ $info->date_end->format('Y-m-d') }} {{ $info->date_end->format('H:i') }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Ilość miejsc: {{ $info->number_seats }}</p>
            </div>
            <div class="btn-container">
            @if ($event->info->isNotEmpty())         
              <button class="btn show-sub-events" data-info-id="{{ $info->id }}">Pokaż szczegóły</button>
              <a href="{{ route('event.edit_details', $info->id) }}" style="width:50px "class="btn btn-danger">Edycja</a>
              <button data-id="{{ $info->id }}"  style="width:50px " class="btn btn-danger des" >Usuń</button>
              <a href="{{ route('zapisz', $info->id) }}" style="width:50px "class="btn btn-danger">Zapis</a>
              @else
              <button class="btn show-sub-events" data-info-id="{{ $info->id }}" disabled>></button>
                    @endif
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
                      <a  href="{{ route('event.show', $event->id) }}" ><button class="btn btn-primary">Pokaż szczegóły</button></a>
                      <a style="margin-right:5px"href="{{ route('event.edit', $event->id) }}" class="btn btn-danger">Edycja</a>
              <a  style="margin-right:5px"href="{{ route('addMember', $event->id)}}" class="btn btn-danger" >Dodaj współpracownika</a>
              <a style="margin-right:5px"href="{{ route('create2', $event->id)}}" class="btn btn-danger" >Dodaj podwydarzenie</a>
              
  

              <button class="btn btn-danger del" data-id="{{ $event->id }}">Usuń</button>

                </div>
             
            </div>
        </div>
        <div id="agreed22" class="dialog" style="display: none;">
    <div class="dialog-content">
        <p id="dese">Opis wydarzenia:</p>
        <p id="eve_dese"></p>
        <button id="cancel-button">Wróć</button>
    </div>
</div>
        @endforeach
    </div>
 
    

   
</div>
<div class="footer">
    <p class="footer-text">@Sławek&Natan Company</p>
    </div>
   
   
@endsection
@section('javascript')
<script src="https://code.jquery.com/jquery-3.6.0.min.js%22%3E"></script>
    <script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $('.del').click(function() {
              var eventId = $(this).data("id");
              var confirmed = window.confirm("Czy na pewno chcesz usunąć to wydarzenie?");
              if (confirmed) {
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
            }
          });
          </script>
             <script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $('.des').click(function() {
            
              var eventId = $(this).data("id");
              var confirmed = window.confirm("Czy na pewno chcesz usunąć to podwydarzenie?");
              if (confirmed) {
              $.ajax({
                  method: "DELETE",
                  url: "http://szkola.test/event-details/" + eventId,
                  headers: {
                      'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                  }
              })

              .done(function(response) {
                  alert("Udało się");
                  window.location.reload();
              })
              .fail(function(response) {
                  alert("Error");
              });
            }
          });
          </script>


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
                    url: "http://szkola.test/user_list" + eventId,
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
            url: "http://szkola.test/user_list/" + eventId,
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
        document.addEventListener('DOMContentLoaded', function() {
      
      var showDetailsButtons = document.querySelectorAll('.show-sub-events');

      showDetailsButtons.forEach(function(button) {
          button.addEventListener('click', function() {
              var dialog = document.getElementById('agreed22');
              dialog.style.display = 'flex'; 
              var description = this.closest('.event-wrapper').getAttribute('data-description');
          var descriptionElement = document.getElementById('eve_dese');
          descriptionElement.textContent = description;
              var cancelButton = document.getElementById('cancel-button');

              cancelButton.addEventListener('click', function() {
           
                  dialog.style.display = 'none'; 
              });
          });
      });
  });
  const deleteButtons = document.querySelectorAll('.delete');

// Iteracja przez przyciski i dodanie obsługi zdarzenia dla każdego
deleteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const eventId = this.getAttribute('data-id');

        // Wysłanie żądania do kontrolera za pomocą fetch lub innej metody
        fetch(`/events/${eventId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Jeśli używasz ochrony CSRF
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(data => {
            // Tutaj możesz obsłużyć odpowiedź z serwera po usunięciu zdarzenia
            console.log(data);
            // Odświeżenie strony lub wykonanie innych akcji
        })
        .catch(error => {
            console.error('Wystąpił błąd podczas usuwania zdarzenia:', error);
        });
    });
});
    </script>
   
@endsection

