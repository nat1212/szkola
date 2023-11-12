@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edycja') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('edit_details.update',$event->id)}}">
                        @csrf

                       
                        <div class="row mb-3">
                            <label for="speaker_first_name" class="col-md-4 col-form-label text-md-end">{{ __('Imię osoby prezentującej') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_first_name" type="text"  class="form-control @error('speaker_first_name') is-invalid @enderror" name="speaker_first_name" value="{{ $event->speaker_first_name}}" required autocomplete="speaker_first_name" autofocus>
                                @error('speaker_first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="speaker_last_name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko osoby prezentującej') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_last_name" type="text"  class="form-control @error('speaker_last_name') is-invalid @enderror" name="speaker_last_name" value="{{ $event->speaker_last_name}}" required autocomplete="speaker_last_name" autofocus>
                                @error('speaker_last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('tytul') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text"  class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $event->title}}"required autocomplete="title" autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                                <input id="events_start" type="hidden" value="{{ $date->date_start }}" class="form-control" name="event_start" required autofocus>
                        
                       
                                <input id="events_end" type="hidden" value="{{ $date->date_end }}" class="form-control" name="event_end" required autofocus>
                        
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local"  class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ $event->date_start}}" required autocomplete="date_start" autofocus>
                                @error('date_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date_end" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local"  class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ $event->date_end}}" required autocomplete="date_end" autofocus>
                                @error('date_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis występu') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text"  class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $event->description}}" required autocomplete="description" autofocus>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comments" class="col-md-4 col-form-label text-md-end">{{ __('Komentarz') }}</label>

                            <div class="col-md-6">
                                <input id="comments" type="text" class="form-control @error('comments') is-invalid @enderror" name="comments" value="{{ $event->comments}}" required autocomplete="comments" autofocus>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="number_seats" class="col-md-4 col-form-label text-md-end">{{ __('Ilość miejsc') }}</label>

                            <div class="col-md-6">
                                <input id="number_seats" type="number"  class="form-control @error('number_seats') is-invalid @enderror" name="number_seats" value="{{ $event->number_seats}}" required autocomplete="number_seats" autofocus>
                                @error('number_seats')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start_rek" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_rek" type="datetime-local"  class="form-control @error('date_start_rek') is-invalid @enderror" name="date_start_rek" value="{{ $event->date_start_rek}}"  required autocomplete="data_roz_rejestr" autofocus>
                                @error('date_start_rek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end_rek" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_end_rek" type="datetime-local"  class="form-control @error('date_end_rek') is-invalid @enderror" name="date_end_rek" value="{{ $event->date_end_rek}}" placeholder="Data zakończenia rejestracji" required autocomplete="data_zak_rejestr" autofocus>
                                @error('date_end_rek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
     

<div class="row mb-2">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Zapisz zmiany') }}
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
</div>
</div>
<div class="footer">
    <p class="footer-text">@Sławek&Natan Company</p>
    </div>
@endsection
