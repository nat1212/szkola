@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endsection
@section('content')
<div class="container">
@if(session('success') || session('error'))
    <div id="notification-message" class="alert alert-{{ session('success') ? 'success' : 'danger' }}">
        {{ session('success') ? session('success') : session('error') }}
    </div>
@endif   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dodaj współpracownika') }}</div>

                <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                       
                            @foreach($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                     
                    </div>
                @endif
                    <form method="POST" action="/addMember">
                        @csrf
                        <input id="events_start" hidden  value="{{ $date->date_start }}" class="form-control" name="event_start" required autofocus>
                        
                       
                        <input id="events_end" hidden value="{{ $date->date_end }}" class="form-control" name="event_end" required autofocus>
                        <div class="row mb-3">
                            <label for="users_id" class="col-md-4 col-form-label text-md-end">{{ __('Email użytkownika') }}</label>

                            <div class="col-md-6">
                            
                                    
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                            <input id="users_id" value="" type="hidden" name="users_id" required autocomplete="email">

                           

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="users_role_dictionary_id" class="col-md-4 col-form-label text-md-end">{{ __('Rola') }}</label>

                            <div class="col-md-6">
                            <select id="role" class="form-control" name="users_role_dictionary_id" required autofocus>
                                @foreach($roles as $key => $role)
                                @if(!$key == 0)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div id="role-description" ></div>
                        </div>
                        
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data wydarzenia głównego') }}</label>
                            <div class="col-md-6">
                            <input id="events_start"  value="{{$date->date_start . ' - ' . $date->date_end}}" class="form-control" name="event_start"  disabled required autofocus>
                            </div>                        
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data początku uprawnień') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control @error('date_start') is-invalid @enderror" name="date_start"  required  autofocus>
                                @error('date_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date_end" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia uprawnień') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local" class="form-control @error('date_end') is-invalid @enderror" name="date_end"  required  autofocus>
                                @error('date_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        

                        <div class="row mb-3">
                           

                            <div class="col-md-6">
                            <input id="events_id" type="hidden" value="{{ $event }}" class="form-control" name="events_id" required  autofocus>                            </div>
                        </div>
                        
                        <input type="hidden" name="additional_property" value="1" />
                       

                       
                       

                      

                       

                        
                         
                        <div class="row mb-0">
                           
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Stwórz') }}
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-primary">
            {{ __('Anuluj') }}
        </a>
                            </div>
                        </div>
                    </form>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$(document).ready(function() {
    $('#role').change(function() {
        var roleId = $(this).val();
        var roleDescription = '';

        // Tutaj możesz dodać warunki, które ustalą odpowiedni opis w zależności od wartości roleId
        if (roleId === '1') {
            roleDescription = 'Opis roli 1';
        } else if (roleId === '2') {
            roleDescription = 'Możliwa praca nad wydarzeniem głównym(za wyjątkiem usunięcia) i podwydarzeniami';
        } else if (roleId === '3') {
            roleDescription = 'Możliwa praca tylko na podwydarzeniach';
        }
        // Dodaj więcej warunków, jeśli masz więcej ról

        $('#role-description').text(roleDescription);
    });
});</script>
<script>
    var notificationMessage = document.getElementById('notification-message');

    if (notificationMessage) {
        setTimeout(function() {
            notificationMessage.style.display = 'none';
        }, 3000);
    }
</script>
@endsection
