@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/list.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 text-center">
            <h1>WYDARZENIA NA UCZELNI:</h1>
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


    @foreach ($events as $event)
    
    <div class="row">
        <div class="table-wrapper ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="name1">{{ $event->name }} </th>
                        
                    </tr>
                </thead>
                
            </table>
           
            <div>
 
            <div class="des-row">
            <div class="left-content">
            
            <div class="des-row">
                    <p scope="col" class="des " >Data rozpoczęcia wydarzenia:</p>
                    <p scope="col" class="des2 ">{{$event->date_start->format('Y-m-d') }} {{ $event->date_start->format('H:i') }}</p>
            </div>
            <div class="des-row">
                    <p scope="col" class="des" >Data zakończenia wydarzenia:</p>
                    <p scope="col" class="des2" >{{ $event->date_end->format('Y-m-d') }} {{ $event->date_end->format('H:i') }}</p>
            </div>
            
                
            <div class="des-row">
   
                    <p scope="col" class="des" >Status wydarzenia:</p>
                    <p scope="col" class="des2" >{{ $event->status->name }}</p>
            </div>
            <div class="des-row">
                        <p scope="col" class="des">Lokalizacja:</p>
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
     
      <div class="event-wrapper"  data-description="{{ $info->description }}">
        <div class="event"> 
          <div class="text">
            <p scope="col" class="des7">{{ $info->title }}</p>
            <div class="des-row2">
              <p scope="col" class="des3">Prowadzący:</p>
              <p scope="col" class="des4">{{ $info->speaker_first_name }} {{ $info->speaker_last_name }}</p>

            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Data rozpoczęcia wydarzenia:</p>
              <p scope="col" class="des4">{{ $info->date_start->format('Y-m-d') }} {{  $info->date_start->format('H:i') }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Data zakończenia wydarzenia:</p>
              <p scope="col" class="des4">{{ $info->date_end->format('Y-m-d') }} {{ $info->date_end->format('H:i') }}</p>
            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Ilość miejsc: {{ $info->number_seats }}</p>
            </div>
      

            <div class="btn-container">
              
              <button class="btn show-sub-events" data-info-id="{{ $info->id }}">Pokaż szczegóły</button>
              @if (strtotime($info->date_start_rek) < strtotime('now') && strtotime($info->date_end_rek) > strtotime('now'))
                @if($info->type == 1)
                  <a href="{{ route('zapisz', $info->id) }}" class="hidden btn">Zapis Grupowy</a>
                  @else
                  <a href="{{ route('zapisznr', $info->id) }}" class="hidden btn">Zapis Grupowy</a>
                @endif
              @else
            
              <span class="btn disabled">Zapis Grupowy</span>
              @endif
            </div>
          </div>
  
          <div class="sub-events" style="display:none;">
            <div class="des-row2">
              <p scope="col" class="des3">Prowadzący:</p>
              <p scope="col" class="des4">{{ $info->speaker_first_name }} {{ $info->speaker_last_name }}</p>

            </div>
            <div class="des-row2">
              <p scope="col" class="des3">Opis:</p>
              <p scope="col" class="des4">{{ $info->description }}</p>
            </div>
           
          </div>
        </div>
      </div>
      
      @endforeach
    </div>
  </div>
</div>


                <div class="d-flex justify-content-end align-items-center">
                @if ($event->info->isNotEmpty())
                    <button class="btn btn-primary expand-button ">Pokaż wydarzenia</button>
                    @else
                    <button class="btn btn-primary expand-button " disabled>></button>
                    @endif
                    <button class="btn btn-primary details-button" data-event-id="{{ $event->id }}">Pokaż szczegóły</button>
                </div>
             
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
    
    <div class="footer">
    <p class="footer-text">@Sławek&Natan Company</p>
    </div>
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

        // Dodajemy poniższy kod, aby automatycznie chować szczegóły podwydarzeń, gdy schowamy wydarzenia
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



 

 
</script>
@endsection
