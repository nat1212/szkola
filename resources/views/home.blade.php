@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/list2.css')}}">
<link rel="stylesheet" href="{{asset('css/list.css')}}">
<link rel="stylesheet" href="{{asset('css/table.css')}}">

@endsection

@section('content')
<div class="container">
@if (session('status'))
                        <div id="status-message" class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="update-message" class="alert alert-success" style="display: none;"></div>
                    @if ($errors->has('status'))
    <div id="update-message2" class="alert alert-danger">
        {{ $errors->first('status') }}
    </div>
@endif
@if(session('success') || session('error'))
    <div id="notification-message" class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
        {{ session('success') ? session('success') : session('error') }}
    </div>
@endif            
     
                    <div id="update-message-container"></div>
<div class="side-bar">
        <div onclick="rat(1)" data-id="1"  class="side-bar-info">
            Profil
        </div>
        <div  onclick="rating(0);toggleExpand()" class="side-bar-underinfo" data-id="1">
            Edycja profilu
        </div>
        <div style="text-align: center;" onclick="rat(2)" data-id="1"  class="side-bar-info">
            Lista twoich wydarzeń
        </div>
        <div style="text-align: center;" onclick="rating(1);closeExpand();" class="side-bar-underinfo" data-id="2">
            Aktualne
        </div>
        <div onclick="rating(2);closeExpand();" class="side-bar-underinfo"data-id="2">
            Wygasłe 
        </div>
        <div  onclick="rat(5);closeExpand();" class="side-bar-info"data-id="5">
            Twoje zapisy
        </div>
        <div   onclick="rating(3);closeExpand();" class="side-bar-underinfo" data-id="5">
            Aktualne
        </div>
        <div  onclick="rating(6);closeExpand();" class="side-bar-underinfo" data-id="5">
            Zakończone
        </div>
        <div  onclick="rat(3)" data-id="1"  class="side-bar-info">
             Zapis grupowy
        </div>
        <div onclick="rating(4);closeExpand();" class="side-bar-underinfo"data-id="3">
            Aktualne
        </div>
        <div onclick="rating(5);closeExpand();" class="side-bar-underinfo"data-id="3">
            Zakończone
        </div>
        <div  onclick="redirectToEventList(event)" class="side-bar-info">
            Wszyskie wydarzenia
        </div>
    </div>
        <div class="col-md-12"> 
            <div class="card card-left">
            <div class="card-header">
                <span>{{ __('Twój profil') }}</span>
               
                    <div class="profile2">
                    
                @if (Auth::user()->last_logout)
            Ostatnio wylogowano:&nbsp;<span>{{ date('d-m-Y H:i', strtotime(Auth::user()->last_logout)) }}</span>
            @else
     
             @endif
             <a style="text-decoration: none;" href="/create">
                        <button type="button" class="btn btn-primary">Dodaj wydarzenie</button>
                    </a>
            </div>
            </div>
                
                <div class="card-body">
                   



                <div class="spacer"></div>
                <div class="table-info selected" data-id="1">
                
                <table id=""  class="table" style="width:100%">
        <thead >
            <tr >
                <th>Nazwa wydarzenia</th>
                <th>Adres</th>
                <th>Data wydarzenia</th>
                <th>Data publikacji</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           
            @foreach ($userEvents as $event)
          
            @if ($event->date_end > now())
            <tr class="parent" onclick="toggleChildren(event)">
                <td title="Kliknij na mnie!" class="toggle-cell">{{  $event->name}}</td>
                <td title="Kliknij na mnie!" class="toggle-cell">{{  $event->location_shortcut}}</td>
                <td  title="Kliknij na mnie!" class="toggle-cell">{{  $event->date_start->format('d-m-Y')}} {{$event->date_start->format('H:i') }}<br>{{  $event->date_end->format('d-m-Y')}} {{$event->date_end->format('H:i') }}</td>
                <td title="Kliknij na mnie!" class="toggle-cell"> {{  $event->date_start_publi->format('d-m-Y')}} {{$event->date_start_publi->format('H:i') }}<br>{{  $event->date_end_publi->format('d-m-Y')}} {{$event->date_end_publi ->format('H:i') }}</td>
                <td title="Kliknij na mnie!"class="toggle-cell"> {{  $event->status->name}}</td>
                <td> 
                    <a  href="{{ route('event.show', $event->id) }}" class="btn btn-danger">Pokaż szczegóły</a>
                    <a style="margin-right:5px"href="{{ route('event.edit', $event->id) }}" class="btn btn-danger">Edycja</a>
                    
                    <a data-id="{{ $event->id }}" class="btn btn-danger event-delete-btn">Usuń</a>
                </td>
                <td>
                    <a  style="margin-right:5px;width:150px"href="{{ route('addMember', $event->id)}}" class="btn btn-danger" >Dodaj współpracownika</a>
                    <a style="margin-right:5px"href="{{ route('create2', $event->id)}}" class="btn btn-danger" >Dodaj podwydarzenie</a>
                </td>
             </tr>
                        <div data-id="{{ $event->id }}" id="delete-dialog" class="dialog">
                        <div class="dialog-content">
                            <p>Czy na pewno chesz usunąć wydarzenie?</p>
                            <button data-id="{{ $event->id }}"class="btn btn-danger del">Tak</button>
                            <button class="btn btn-primary cancel-delete-button">Nie</button>
                        </div>
                    </div>
            @endif
           

            
            <tr class="table-secondary child">
            <th>Tytuł</th>
                <th>Prowadzący</th>
                <th>Data wydarzenia</th>
                <th>Komentarz</th>
                <th>Wolne miejsca</th>
                <th>Rejestracja</th>
                <th>
                    
                </th>
                <th>
                    
                    </th>
            </tr>
            
            @foreach ($event->info as $info)
            <tr  class="table-secondary child">
                <td>{{  $info->title}}</td>
                <td>{{ $info->speaker_first_name }} {{ $info->speaker_last_name }}</td>
                <td style="width:140px;">{{ $info->date_start->format('Y-m-d') }} {{  $info->date_start->format('H:i') }} <br> {{ $info->date_end->format('Y-m-d') }} {{ $info->date_end->format('H:i') }}</td>
                <td>{{ $info->comments }}</td>
                <td>{{ $info->number_seats }}</td>
                <td>{{ $info->date_start_rek->format('Y-m-d') }} {{  $info->date_start_rek->format('H:i') }} <br> {{ $info->date_end_rek->format('Y-m-d') }} {{ $info->date_end_rek->format('H:i') }}</td>
                <td>
                    <a href="{{ route('event.edit_details', $info->id) }}" style="width:80px "class="btn btn-danger">Edycja</a>
                    <a  data-id="{{ $info->id }}" class="btn btn-danger event-delete-btn">Usuń</a>
                </td>
                <td>
                    @if($info->type==1)
                    <a href="{{ route('zapisz', $info->id) }}" style="width:80px "class="btn btn-danger">Lista</a>
                    @else
                    <a href="{{ route('zapisznr', $info->id) }}" style="width:80px "class="btn btn-danger">Lista</a>
                    @endif
                    <a class="btn btn-danger show-sub-event" data-result-id="{{ $info->id }}" data-description="{{ $info->description }}">Pokaż szczegóły</a>

                </td>
         </tr>
                
            <div data-id="{{ $info->id }}" id="delete-dialog" class="dialog">
            <div class="dialog-content">
                <p>Czy na pewno chesz usunąć podwydarzenie?</p>
                <button data-id="{{ $info->id }}" class="btn btn-danger usu" >Tak</button>
                <button class="btn btn-primary cancel-delete-button">Nie</button>
            </div>
        </div>
            @endforeach
         
            @endforeach
           
            </tbody>
       
    </table>
</div>
    <div class="table-info" data-id="2">
                
                <table id=""  class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nazwa wydarzenia</th>
                <th>Adres</th>
                <th>Data wydarzenia</th>
                <th>Data publikacji</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
           
            @foreach ($userEvents as $event)
          
            @if ($event->date_end <= now())
            <tr class="parent">
            <tr  class="parent" onclick="toggleChildren(event)">
                <td title="Kliknij na mnie!" class="toggle-cell">{{  $event->name}}</td>
                <td title="Kliknij na mnie!" class="toggle-cell">{{  $event->location_shortcut}}</td>
                <td title="Kliknij na mnie!" class="toggle-cell">{{  $event->date_start->format('d-m-Y')}} {{$event->date_start->format('H:i') }}<br>{{  $event->date_end->format('d-m-Y')}} {{$event->date_end->format('H:i') }}</td>
                <td title="Kliknij na mnie!" class="toggle-cell"> {{  $event->date_start_publi->format('d-m-Y')}} {{$event->date_start_publi->format('H:i') }}<br>{{  $event->date_end_publi->format('d-m-Y')}} {{$event->date_end_publi ->format('H:i') }}</td>
                <td title="Kliknij na mnie!" class="toggle-cell"> {{  $event->status->name}}</td>
           
            </tr>

            @endif
            <tr class="table-secondary child">
            <th>Tytuł</th>
                <th>Prowadzący</th>
                <th>Data wydarzenia</th>
                <th>Wolne miejsca</th>
                <th>Rejestracja</th>
               
            </tr>
            @foreach ($event->info as $info)
            <tr  class="table-secondary child">
            <td>{{ $info->title}}</td>
            <td>{{ $info->speaker_first_name }} {{ $info->speaker_last_name }}</td>
            <td>{{ $info->date_start->format('Y-m-d') }} {{  $info->date_start->format('H:i') }} <br> {{ $info->date_end->format('Y-m-d') }} {{ $info->date_end->format('H:i') }}</td>
            <td>{{ $info->number_seats }}</td>
            <td>{{ $info->date_start_rek->format('Y-m-d') }} {{  $info->date_start_rek->format('H:i') }} <br> {{ $info->date_end_rek->format('Y-m-d') }} {{ $info->date_end_rek->format('H:i') }}</td>
        
         </tr>
            @endforeach
         
            @endforeach
           
            </tbody>
       
    </table>


</div>
<div class="table-info" data-id="3">
                
                <table id=""  class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nazwa wydarzenia</th>
                <th>Tytuł wydarzenia</th>
                <th>Prowadzący</th>
                <th>Data wydarzenia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
       
        @if(isset($yourEvents))
            @foreach ($yourEvents as $yourEvent)
            @if ($yourEvent->date_end > now())

            <tr>
            <td>{{  $yourEvent->name}}</td>
            <td>{{  $yourEvent->title}}</td>
            <td>{{  $yourEvent->speaker_first_name}} {{  $yourEvent->speaker_last_name}}</td>
            <td> {{  $yourEvent->date_start->format('d-m-Y')}} godz. {{$yourEvent->date_start->format('H:i') }}<br>{{  $yourEvent->date_end->format('d-m-Y')}} godz. {{$yourEvent->date_end->format('H:i') }}</td>
            <td> 
            @if ($yourEvent->date_start > now())
            <a href="/leave/{{ $yourEvent->id }}" class="btn btn-primary leave-button leave-event-btn" data-date-start="{{ $yourEvent->date_start->format('Y-m-d H:i:s') }}" >Wypisz się</a>
            @else
                <a href="javascript:void(0)"  class="btn btn-primary disabled">Wypisz się</a>
            @endif
            <button class="btn btn-primary show-sub-event" data-result-id="{{ $yourEvent->id }}"data-description="{{ $yourEvent->description }}">Pokaż szczegóły</button>
            </td>

            @endif
            @endforeach
            @endif
           
            </tbody>
      
    </table>
</div>
<div class="table-info" data-id="6">
                
                <table id=""  class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nazwa wydarzenia</th>
                <th>Tytuł wydarzenia</th>
                <th>Prowadzący</th>
                <th>Data wydarzenia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
       
        @if(isset($yourEvents))
            @foreach ($yourEvents as $yourEvent)
            @if ($yourEvent->date_end <= now())

            <tr>
            <td>{{  $yourEvent->name}}</td>
            <td>{{  $yourEvent->title}}</td>
            <td>{{  $yourEvent->speaker_first_name}} {{  $yourEvent->speaker_last_name}}</td>
            <td> {{  $yourEvent->date_start->format('d-m-Y')}} godz. {{$yourEvent->date_start->format('H:i') }}<br>{{  $yourEvent->date_end->format('d-m-Y')}} godz. {{$yourEvent->date_end->format('H:i') }}</td>
            <td> 
            @if ($yourEvent->date_start > now())
            <a href="/leave/{{ $yourEvent->id }}" class="btn btn-primary leave-button leave-event-btn" data-date-start="{{ $yourEvent->date_start->format('Y-m-d H:i:s') }}" >Wypisz się</a>
            @else
                <a href="javascript:void(0)"  class="btn btn-primary disabled">Wypisz się</a>
            @endif
            <button class="btn btn-primary show-sub-event" data-result-id="{{ $yourEvent->id }}"data-description="{{ $yourEvent->description }}">Pokaż szczegóły</button>
            </td>

            @endif
            @endforeach
            @endif
           
            </tbody>
      
    </table>
</div>
<div class="table-info" data-id="4">
                
        <table id=""  class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nazwa wydarzenia</th>
                <th>Nazwa podwydarzenia</th>
                <th>Liczba osób</th>
                <th>Typ listy</th>
                <th>Data wydarzenia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
       
     
            @foreach ($groups as $group)
            @if ($group->date_end > now())
          
            <tr>
            <td>{{  $group->name}}</td>
            <td>{{  $group->title}}</td>
            <td>{{  $group->number_of_people}}</td>
            <td>{{  $group->type}}</td>
            <td> {{  $group->date_start->format('d-m-Y')}} godz. {{$group->date_start->format('H:i') }}<br>{{  $group->date_end->format('d-m-Y')}} godz. {{$group->date_end->format('H:i') }}</td>
            <td>
             @if( $group->type==1)
            <a href="{{ route('list',$group->participant_id,) }}" data-date-start="{{ $group->date_start->format('Y-m-d H:i:s') }}" class="btn btn-danger leave">Lista</a>
            @else
            <a href="{{ route('listnr',$group->participant_id,) }}" data-date-start="{{ $group->date_start->format('Y-m-d H:i:s') }}" class="btn btn-danger leave">Lista</a>     </td>
            @endif
            </tr>
          
            
            @endif
            @endforeach
            
            
           
            </tbody>
       
    </table>
</div>
<div class="table-info" data-id="5">
                
        <table id=""  class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nazwa wydarzenia</th>
                <th>Nazwa podwydarzenia</th>
                <th>Liczba osób</th>
                <th>Typ listy</th>
                <th>Data wydarzenia</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
       
     
            @foreach ($groups as $group)
            @if ($group->date_end < now())
          
            <tr>
            <td>{{  $group->name}}</td>
            <td>{{  $group->title}}</td>
            <td>{{  $group->number_of_people}}</td>
            <td>{{  $group->type}}</td>
            <td> {{  $group->date_start->format('d-m-Y')}} godz. {{$group->date_start->format('H:i') }}<br>{{  $group->date_end->format('d-m-Y')}} godz. {{$group->date_end->format('H:i') }}</td>
            <td>
             @if( $group->type==1)
            <a href="{{ route('list',$group->participant_id,) }}" data-date-start="{{ $group->date_start->format('Y-m-d H:i:s') }}" class="btn btn-danger leave">Lista</a>
            @else
            <a href="{{ route('listnr',$group->participant_id,) }}" data-date-start="{{ $group->date_start->format('Y-m-d H:i:s') }}" class="btn btn-danger leave">Lista</a>     </td>
            @endif
            </tr>
          
            
            @endif
            @endforeach
            
            
           
            </tbody>
       
    </table>
</div>
                <!-- <h4 class="expand-toggle" onclick="redirectToEventUserList()">Lista twoich wydarzeń:  <span class="toggle-icon">►</span></h4>

                    <div class="spacer"></div>

                    <h4 class="expand-toggle" onclick="redirectToEventList()">Lista wszystkich wydarzeń:  <span class="toggle-icon">►</span></h4> -->
     
                <div class="grid-wrapper2">

                <div class="container2">
                <div class="col-md-8">
                <div class="card mx-auto" style="width: 800px;">
    <div class="card-header">{{ __('Edycja Profilu') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('user.updateProfile', $user->id) }}">
            @csrf
            <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                            <div class="input-container">
                                                <input id="email" type="text" class="form-control tracked-field" name="email" value="{{ $user->email }}" placeholder="Email" required autocomplete="Email" autofocus>
                                                <div class="note">Uwaga! Przy zmianie e-maila potrzebna bedzie ponowna weryfikacja!</div>
                                                
                                            </div>                               
                             
                            </div>
                        </div>
            <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Imię') }}</label>

                            <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" placeholder="Imię" required autocomplete="Imię" autofocus>
                               
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko') }}</label>

                            <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" placeholder="Nazwisko" required autocomplete="Nazwisko" autofocus>
                               
                             
                            </div>
                        </div>
            

           <div class="row mb-3">
                <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="cancelChanges()">Anuluj</button>
                </div>
            </div>
        </form>

        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                <a href="zmien-haslo" class="btn btn-primary">Zmień hasło</a>
            </div>
        </div>
    </div>
</div>

                    </div>
</div>

    </div>
</div>
<div id="leave-dialog" class="dialog">
    <div class="dialog-content">
        <p>Czy na pewno chesz wypisać się z wydarzenia</p>
        <button id="confirm-leave-button">Tak</button>
        <button id="cancel-leave-button">Nie</button>
    </div>
</div>

<div id="agreed2" class="dialog2" style="display: none;">
    <div class="dialog-content2">
        <p id="dese">Opis wydarzenia:</p>
        <p id="eve_dese"></p>
        <button class="btn btn-primary" id="cancel2-button">Wróć</button>
    </div>
</div>
</div>
                    </div>
                    <div class="footer">
    <p class="footer-text">@Sławek&Natan Company</p>




    
    </div>
    



    <script>


document.addEventListener('DOMContentLoaded', function() {
    var showDetailsButtons = document.querySelectorAll('.show-sub-event');
    var dialog = document.getElementById('agreed2');
    var cancelButton = document.getElementById('cancel2-button');

    showDetailsButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var description = this.closest('.show-sub-event').getAttribute('data-description');
            var descriptionElement = document.getElementById('eve_dese');
            descriptionElement.textContent = description;

            dialog.style.display = 'flex';
        });
    });

  
    dialog.addEventListener('click', function(event) {
        if (event.target === dialog) {
            dialog.style.display = 'none';
            resetDialog();
        }
    });

    cancelButton.addEventListener('click', function() {
        dialog.style.display = 'none';
        resetDialog();
    });
    function resetDialog() {
    var descriptionElement = document.getElementById('eve_dese');
    descriptionElement.textContent = ''; 


    var dialogContent = document.querySelector('.dialog-content2');
    dialogContent.scrollTop = 0;
}
});
var leaveButtons = document.querySelectorAll('.leave-event-btn');


leaveButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        var dialog = document.getElementById('leave-dialog');
        dialog.style.display = 'flex';

        var id = this.getAttribute('href').split('/').pop();
        dialog.setAttribute('data-entry-id', id);
    });
});
document.getElementById('confirm-leave-button').addEventListener('click', function() {
        var dialog = document.getElementById('leave-dialog');
        dialog.style.display = 'none';

        var id = dialog.getAttribute('data-entry-id');


        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/leave/' + id, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                console.log(xhr.responseText)
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                    var updateMessage = document.getElementById('update-message');
                    updateMessage.textContent = response.message;
                    updateMessage.style.display = 'block'; 
                    setTimeout(function() {
                        updateMessage.style.display = 'none'; 
                        location.reload();
                    }, 1500); 
                } 
            } 
        }
    };
        xhr.send();
        var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'none';
    });

    document.getElementById('cancel-leave-button').addEventListener('click', function() {
        var dialog = document.getElementById('leave-dialog');
        dialog.style.display = 'none';
    });




function rat(x) {
 
    const dataId = `[data-id="${x}"]`;
    const side_bar = document.querySelectorAll(`.side-bar-underinfo${dataId}`);

    side_bar.forEach(div => {
    if (div.classList.contains("selected")) {
        div.classList.remove("selected");
    } else {
        div.classList.add("selected");
    }
    });
  
}


</script>
<script>
    var leaveButtons = document.querySelectorAll('.event-delete-btn');

leaveButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        var dataId = button.getAttribute('data-id');
        var dialog = document.querySelector('[data-id="' + dataId + '"]#delete-dialog');

        if (dialog) {
            dialog.style.display = 'flex';
        }
    });
});

var cancelButtons = document.querySelectorAll('.cancel-delete-button');

cancelButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var dialog = button.closest('.dialog');
        if (dialog) {
            dialog.style.display = 'none';
        }
    });
});


</script>






<script>



function rating(x) {
    number = x;
    console.log(number);
    const dataId = `[data-id="${x}"]`;
    console.log(typeof(dataId));
    const buttons = document.querySelectorAll(".table-info");
    buttons.forEach(div => div.classList.remove("selected"));
  
   // const selectedButton = document.querySelector(`.side-bar-info${dataId}`);
    const underinfoElements = document.querySelectorAll(`.table-info${dataId}`);
   // selectedButton.classList.add("selected");
    underinfoElements.forEach(div => div.classList.add("selected"));
}
document.addEventListener('DOMContentLoaded', function() {
    const underinfoElements = document.querySelectorAll('.side-bar-underinfo');

    underinfoElements.forEach(element => {
        element.addEventListener('click', function() {
     
            underinfoElements.forEach(div => div.classList.remove('active'));

            this.classList.add('active');
        });
    });
});
</script>
<script>
function toggleChildren(event) {
    var target = event.target;
    if (target.classList.contains('toggle-cell')) {
        // Find all child rows (<tr> elements with class "child") that are immediate siblings of the clicked parent row
        var childRows = [];
        var parentRow = target.parentNode;
        var sibling = parentRow.nextElementSibling;
        while (sibling && sibling.classList.contains('child')) {
            childRows.push(sibling);
            sibling = sibling.nextElementSibling;
        }

        // Toggle visibility only for the immediate child rows of the clicked parent row
        childRows.forEach(function(childRow) {
            if (childRow.style.display === 'none' || childRow.style.display === '') {
                childRow.style.display = 'table-row';
            } else {
                childRow.style.display = 'none';
            }
        });
    }
}


</script>
<script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $('.usu').click(function() {
            
              var eventId = $(this).data("id");
             
              
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
                  alert("Nie udało się");
              });
            
          });
          </script>
<script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');

          $('.del').click(function() {
              var eventId = $(this).data("id");
             
             
              $.ajax({
                  method: "DELETE",
                  url: "http://szkola.test/event/" + eventId,
                  headers: {
                      'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                  }
              })

              .done(function(response) {
                alert("Udało się");
                  window.location.reload();
              })
              .fail(function(response) {
                  alert("Nie udało się");
              });
            
          });
          </script>
             
    <script>

function closeExpand() {
    const gridWrapper2 = document.querySelector('.grid-wrapper2');
    gridWrapper2.style.display = 'none';
}


function toggleExpand() {
    const gridWrapper2 = document.querySelector('.grid-wrapper2');
    if (gridWrapper2.style.display === 'block') {
        gridWrapper2.style.display = 'none';
    } else {
        gridWrapper2.style.display = 'block';
    }
}

function redirectToEventList() {
  window.location.href = "{{ route('event.list') }}";
}

function redirectToEventUserList() {
  window.location.href = "{{ route('user_list') }}";
}
document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = '{{ csrf_token() }}';
var updateProfileBtn = document.getElementById('updateProfileBtn');
    var formInputs = document.querySelectorAll('.tracked-field');

    var sexField = document.getElementById('sex');
    var birthDateField = document.getElementById('birth_date');

    var originalValues = {};

    formInputs.forEach(function(input) {
        originalValues[input.id] = input.value;

        input.addEventListener('input', function() {
            var anyFieldFilled = Array.from(formInputs).some(function(input) {
                return input.value.trim() !== '';
            });

            var anyValueChanged = Array.from(formInputs).some(function(input) {
                return input.value !== originalValues[input.id];
            });

            updateProfileBtn.disabled = !anyFieldFilled || !anyValueChanged;
        });
    });

    sexField.addEventListener('change', function() {
        updateProfileBtn.disabled = false;
    });

    birthDateField.addEventListener('input', function() {
        updateProfileBtn.disabled = false;
    });
});



document.getElementById('updateProfileBtn').addEventListener('click', function() {
    var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'flex';
});

document.getElementById('confirm-button').addEventListener('click', function() {
    var form = document.getElementById('updateProfileForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var updateMessage = document.getElementById('update-message');
                    updateMessage.textContent = response.message;
                    updateMessage.style.display = 'block'; 
                    setTimeout(function() {
                        updateMessage.style.display = 'none'; 
                        location.reload();
                    }, 1500); 
                } else {
                    var updateMessage = document.getElementById('update-message2');
                    updateMessage.textContent = response.message;
                    updateMessage.style.display = 'block'; 
                    setTimeout(function() {
                        updateMessage.style.display = 'none'; 
                        location.reload();
                    }, 3000);
                }
            } 
            loadingElement.style.display = 'none';
        }
    };

    xhr.open('POST', form.action);
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.send(formData);

    var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'none';
});

document.getElementById('cancel-button').addEventListener('click', function() {
    var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'none';
});



  



</script>

<script>
    var notificationMessage = document.getElementById('notification-message');

    if (notificationMessage) {
        setTimeout(function() {
            notificationMessage.style.display = 'none';
        }, 3000);
    }
</script>
@endsection
