@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Podwydarzenie') }}</div>

                <div class="card-body">
                    <form method="POST" action="/create2">
                        @csrf

                        <div class="row mb-3">
                            <label for="speaker_first_name" class="col-md-4 col-form-label text-md-end">{{ __('Imię osoby prezentującej') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_first_name" type="text"  class="form-control @error('speaker_first_name') is-invalid @enderror" name="speaker_first_name" value="{{ old('speaker_first_name') ?? session('speaker_first_name') }}" required autocomplete="speaker_first_name" autofocus>
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
                                <input id="speaker_last_name" type="text"  class="form-control @error('speaker_last_name') is-invalid @enderror" name="speaker_last_name" value="{{ old('speaker_last_name') ?? session('speaker_last_name') }}" required autocomplete="speaker_last_name" autofocus>
                                @error('speaker_last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Tytuł') }}</label>

                            <div class="col-md-6">
                                <textarea id="title" type="text"  class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? session('title') }}" required autocomplete="title" autofocus></textarea>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data wydarzenia głównego') }}</label>
                            <div class="col-md-6">
                            <input id="events_start"  value="{{$event->date_start->format('Y-m-d H:i') . ' - ' . $event->date_end->format('Y-m-d H:i')}}" class="form-control" name="event_start" disabled autofocus>
                            </div>                        
                        </div>
                                <input id="events_start" type="hidden" value="{{ $event->date_start }}" class="form-control" name="event_start" required autofocus>
                        
                       
                                <input id="events_end" type="hidden" value="{{ $event->date_end }}" class="form-control" name="event_end" required autofocus>
                        
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local"  class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start') ?? session('date_start') }}" required autocomplete="date_start" autofocus>
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
                                <input id="date_end" type="datetime-local"  class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end') ?? session('date_end') }}" required autocomplete="date_end" autofocus>
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
                                <textarea id="description" type="text"  class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? session('description') }}" required autocomplete="description" autofocus></textarea>
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
                                <textarea id="comments" type="text" class="form-control @error('comments') is-invalid @enderror" name="comments" value="{{ old('comments') ?? session('comments') }}"  autocomplete="comments" autofocus></textarea>
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
                                <input id="number_seats" type="number"  class="form-control @error('number_seats') is-invalid @enderror" name="number_seats" value="{{ old('number_seats') ?? session('number_seats') }}" required autocomplete="number_seats" autofocus>
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
                                <input id="date_start_rek" type="datetime-local"  class="form-control @error('date_start_rek') is-invalid @enderror" name="date_start_rek"   required autocomplete="data_roz_rejestr" autofocus>
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
                                <input id="date_end_rek" type="datetime-local"  class="form-control @error('date_end_rek') is-invalid @enderror" name="date_end_rek" value="{{ session('date_end_rek') }}" placeholder="Data zakończenia rejestracji" required autocomplete="data_zak_rejestr" autofocus>
                                @error('date_end_rek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Typ listy') }}</label>

                            <div class="col-md-6">
                            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required autocomplete="type" autofocus>
                                <option value="1" >Imienna</option>
                                <option value="2" >Numeryczna</option>
                            </select>                               
                             @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">  
                            <input id="events_id" type="hidden" value="{{ $event->id }}" class="form-control" name="events_id" required  autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                           
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj podwydarzenie') }}
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
@endsection
