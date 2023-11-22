@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endsection
@section('content')
<div style="margin-bottom:25px;" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if(session('success') || session('error'))
    <div id="notification-message" class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
        {{ session('success') ? session('success') : session('error') }}
    </div>
@endif  
                <div class="card-header">{{ __('Podgląd') }}</div>
                <div class="row mb-0">
        <div style="margin:15px">
            <a id="toggle-button" type="button" class="btn btn-primary">
            Twoje wydarzenie: ►
            </a>
        </div>
        <div style="margin-left:15px;margin-bottom:15px">
            <button id="toggle-button-members" type="button" class="btn btn-primary">
            Współpracownicy: ►
            </button>
        </div>
        <!-- <div style="margin-left:15px;margin-bottom:15px">
            <a id="toggle-button-details" type="button" class="btn btn-primary">
            Lista podwydarzeń: ►
            </a>
        </div> -->
        <div style="margin-left:15px;margin-bottom:15px">
        <a href="{{route('home')}}">
            <button type="submit" class="btn btn-primary">
                {{ __('Wróć') }}
            </button>
            </a>
            </div>
        </div>
 
                <div class="card-body">
              
                        <div style=" display: grid;
                            grid-template-columns: 1fr 1fr;
                            column-gap: 16px;
                            row-gap: 40px;" class="des-row">
                            <div style="margin-left:50px;
                            " class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Nazwa:</p>
                                        <textarea id="name" type="text" class="form-control" name="name" disabled>{{ $event->name }}</textarea>
                                </div>
                            </div>
                            <div style="margin-right:50px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Skrót:</p>
                                        <textarea id="shortcut" type="text" class="form-control" name="shortcut" disabled>{{ $event->shortcut }}</textarea>
                                </div>
                            </div>
                            <div style="margin-left:50px;
                            " class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Data rozpoczęcia:</p>
                                        <textarea id="date_start" type="datetime-local" class="form-control" name="date_start"disabled>{{ $event->date_start }}</textarea>
                                </div>
                            </div>
                            <div style="margin-right:50px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Data zakończenia:</p>
                                        <textarea id="date_end" type="datetime-local" class="form-control" name="date_end" disabled>{{ $event->date_end }}</textarea>
                                </div>
                            </div>
                            <div style="margin-left:50px;
                            " class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Miasto:</p>
                                        <textarea id="city" type="text" class="form-control" name="city" disabled>{{ $event->city  }}</textarea>
                                </div>
                            </div>
                            <div style="margin-right:50px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Ulica:</p>
                                        <textarea id="street" type="text" class="form-control" name="street" disabled>{{ $event->street  }}</textarea>
                                </div>
                            </div>
                            <div style="margin-left:50px;
                            " class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Kod pocztowy:</p>
                                        <textarea id="zip_code" type="text" class="form-control" name="zip_code" disabled>{{ $event->zip_code  }}</textarea>
                                </div>
                            </div>
                            <div style="margin-right:50px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Nr budynku:</p>
                                        <textarea id="no_building" type="text" class="form-control" name="no_building" disabled>{{ $event->no_building }}</textarea>
                                </div>
                            </div>
                            <div style="margin-left:50px;
                            " class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Nr pomieszczenia:</p>
                                        <textarea id="no_room" type="text" class="form-control" name="no_room" disabled>{{ $event->no_room  }}</textarea>
                                </div>
                            </div>
                            <div style="margin-right:50px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Lokalizajca skrot:</p>
                                        <textarea id="location_shortcut" type="text" class="form-control" name="location_shortcut" disabled>{{ $event->location_shortcut  }}</textarea>
                                </div>
                            </div>
                            <div style="margin-left:50px;
                            " class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Data rozpoczęcia publikacji:</p>
                                        <textarea id="date_start_publi" type="datetime-local" class="form-control" name="date_start_publi" disabled>{{ $event->date_start_publi  }}</textarea>
                                </div>
                            </div>
                            <div style="margin-right:50px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Data zakończenia publikacji:</p>
                                        <textarea id="date_end_publi" type="datetime-local" class="form-control" name="date_end_publi"disabled>{{ $event->date_end_publi  }}</textarea>
                                </div>
                            </div>
                            
                          
                           
                        </div>
                        <div style="margin-right:50px; margin-left:50px; margin-top:15px; margin-bottom:15px;
                            "
                            class="left-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Status:</p>
                                        <select id="status" class="form-control" name="statuses_id" required autofocus disabled>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $event->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="margin-right:50px; margin-left:50px; margin-top:15px; margin-bottom:15px;
                            "class="right-content">
                                <div class="des-row">
                                        <p scope="col" class="des " >Opiss:</p>
                                        <textarea id="description" class="form-control" name="description" disabled>{{ $event->description }}</textarea>
                                </div>
                            </div>
                            <!-- <div style="display: flex; justify-content: center;">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Zapisz zmiany') }}
                            </button>
                            </div> -->


                   

                      
                  
                    </div>
                   
                    
                   <div class="members"  style=" display: grid;
                            grid-template-columns: 1fr 1fr;
                            column-gap: 16px;
                            row-gap: 40px;">
                    @foreach ($result as $row)
                    <form method="POST" action="{{ route('updateData', $row->id) }}">
                    @csrf
                    <div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Rozpoczecie uprawnień') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control" name="date_start" value="{{ $row->date_start }}" >
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Zakończenie uprawnień') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local" class="form-control" name="date_end" value="{{ $row->date_end }}" >
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Rola') }}</label>

                            <div class="col-md-6">
                                <select id="role_name_select" class="form-control" name="selected_role" required autofocus>
                                @foreach($roles as $role)
                                    @if($role->id !== 1)
                                        <option value="{{ $role->id }}" {{ $row->users_role_dictionary_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endif                                
                                @endforeach
                            </select>
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Email użytkownika') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control" name="status" value="{{ $row->email }}" disabled>
                            </div>
                    </div>
                    <div style="display:flex; justify-content: center;" class="row mb-3">
                    <button style="width:160px;margin-right:10px "data-id="{{ $row->id }}" class="btn btn-danger del" >Zabierz uprawnienia</button>
                    
                    <button style="width:170px;"type="submit" class="btn btn-primary">
                                {{ __('Zapisz zmiany') }}
                            </button>
                    </div>
                    </div>
                    </form>
                    @endforeach
                    </div>
                    
                    <!-- <div class="details" style=" display: grid;
                            grid-template-columns: 1fr 1fr;
                            column-gap: 16px;
                            row-gap: 40px;">
                    
                    @foreach($eventDetails as $detail)
                    @if ($detail->deleted_at==Null) 
                    <form method="POST" action="{{route('edit_details.update',$detail->id)}}">
                        @csrf
                    <div style="max-height: 400px;  overflow-y: auto;  padding: 20px;">
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Tytuł podwydarzenia') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $detail->title }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Imie prowadzącego') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_first_name" type="text" class="form-control" name="speaker_first_name" value="{{ $detail->speaker_first_name }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko prowadzącego') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_last_name" type="text" class="form-control" name="speaker_last_name" value="{{ $detail->speaker_last_name }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="text" class="form-control" name="date_start" value="{{ $detail->date_start }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Data zakonczenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="text" class="form-control" name="date_end" value="{{ $detail->date_end }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Opiss') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $detail->description }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Komentarz') }}</label>

                            <div class="col-md-6">
                                <input id="comments" type="text" class="form-control" name="comments" value="{{ $detail->comments }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Liczba wolnych miejsc') }}</label>

                            <div class="col-md-6">
                                <input id="number_seats" type="text" class="form-control" name="number_seats" value="{{ $detail->number_seats }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Rozpoczecie rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_rek" type="text" class="form-control" name="date_start_rek" value="{{ $detail->date_start_rek }}" >
                            </div>
                            
                    </div>
                    <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Zakończenie rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_end_rek" type="text" class="form-control" name="date_end_rek" value="{{ $detail->date_end_rek }}" >
                            </div>
                            
                    </div>
                   
                    <div class="row mb-3">
                       
                    @foreach ($groups as $group)
                   
                        @if ($group->date_end > now())

                       
                        @if ($group->date_start > now())
                        @if ($group->id == $detail->id)
                        <a href="{{ route('list',$group->participant_id,) }}" style=" margin-left:70px;margin-bottom:30px;width:250px;"class="btn btn-danger">{{ $group->title }}</a>
                                    @else
                                    <a href="{{ route('list', $group->id) }}" class="btn btn-danger disabled">{{ $group->title }}</a>
                                    @endif
                                    @endif
                        @endif
                    @endforeach   
                   
                    </div>
                   
                        
                                
                           
                     
                </div>
                <div style="margin-bottom: 20px; margin-top: 20px;" class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Zapisz zmiany') }}
                        </button>
                    
                    </div> 
                </form>
                @endif  
                @endforeach
                 
                </div> -->
                
                </div>
            </div>
        </div>
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
              var confirmed = window.confirm("Czy na pewno chcesz zabrać uprawnienia?");
              if (confirmed) {
              $.ajax({
                  method: "DELETE",
                  url: "http://szkola.test/event-services/" + eventId,
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
          }});
          </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggle-button');
        const cardBody = document.querySelector('.card-body');

        toggleButton.addEventListener('click', function() {
            cardBody.classList.toggle('d-none');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggle-button-members');
        const cardBody = document.querySelector('.members');

        toggleButton.addEventListener('click', function() {
            cardBody.classList.toggle('d-none');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggle-button-details');
        const cardBody = document.querySelector('.details');

        toggleButton.addEventListener('click', function() {
            cardBody.classList.toggle('d-none');
        });
    });
   
</script>
@endsection