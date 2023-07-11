@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Wydarzenie_detale') }}</div>

                <div class="card-body">
                    <form method="POST" action="/create2">
                        @csrf

                        <div class="row mb-3">
                            <label for="speaker_first_name" class="col-md-4 col-form-label text-md-end">{{ __('Imię osoby prezentującej') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_first_name" type="text" class="form-control" name="speaker_first_name" value="{{ old('speaker_first_name') ?? session('speaker_first_name') }}" required autocomplete="speaker_first_name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="speaker_last_name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko osoby prezentującej') }}</label>

                            <div class="col-md-6">
                                <input id="speaker_last_name" type="text" class="form-control" name="speaker_last_name" value="{{ old('speaker_last_name') ?? session('speaker_last_name') }}" required autocomplete="speaker_last_name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('tytul') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') ?? session('title') }}" required autocomplete="title" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control" name="date_start" value="{{ old('date_start') ?? session('date_start') }}" required autocomplete="date_start" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date_end" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local" class="form-control" name="date_end" value="{{ old('date_end') ?? session('date_end') }}" required autocomplete="date_end" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis występu') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') ?? session('description') }}" required autocomplete="description" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comments" class="col-md-4 col-form-label text-md-end">{{ __('Komentarz') }}</label>

                            <div class="col-md-6">
                                <input id="comments" type="text" class="form-control" name="comments" value="{{ old('comments') ?? session('comments') }}" required autocomplete="comments" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="number_seats" class="col-md-4 col-form-label text-md-end">{{ __('Ilość miejsc') }}</label>

                            <div class="col-md-6">
                                <input id="number_seats" type="number" class="form-control" name="number_seats" value="{{ old('number_seats') ?? session('number_seats') }}" required autocomplete="number_seats" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">  
                            <input id="events_id" type="hidden" value="{{ $event }}" class="form-control" name="events_id" required  autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                           
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Stwórz') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
