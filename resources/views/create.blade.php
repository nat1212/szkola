@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Wydarzenie') }}</div>

                <div class="card-body">
                    <form method="POST" action="create">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>

                            <div class="col-md-6">
                                <textarea id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ session('name') }}" placeholder="Nazwa" required autocomplete="nazwa" autofocus></textarea>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="shortcut" class="col-md-4 col-form-label text-md-end">{{ __('Skrot') }}</label>

                            <div class="col-md-6">
                                <input id="shortcut" type="text" class="form-control @error('shortcuts') is-invalid @enderror" name="shortcut" value="{{ session('shortcut') }}" placeholder="Skrot" required autocomplete="skrot" autofocus>
                                @error('shortcut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Miasto') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ session('city') }}" placeholder="Miasto" required autocomplete="miasto" autofocus>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="street" class="col-md-4 col-form-label text-md-end">{{ __('Ulica') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text"class="form-control @error('street') is-invalid @enderror" name="street" value="{{ session('street') }}" placeholder="Ulica" required autocomplete="ulica" autofocus>
                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-end">{{ __('Kod pocztowy') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ session('zip_code') }}" placeholder="Kod pocztowy" required autocomplete="kod_pocztowy" autofocus>
                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_building" class="col-md-4 col-form-label text-md-end">{{ __('Nr budynku') }}</label>

                            <div class="col-md-6">
                                <input id="no_building" type="text" class="form-control @error('no_building') is-invalid @enderror" name="no_building" value="{{ session('no_building') }}" placeholder="Nr budynku" required autocomplete="nr_budynku" autofocus>
                                @error('no_building')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_room" class="col-md-4 col-form-label text-md-end">{{ __('Nr pomieszczenia') }}</label>

                            <div class="col-md-6">
                                <input id="no_room" type="text" class="form-control @error('no_room') is-invalid @enderror" name="no_room" value="{{ session('no_room') }}" placeholder="Nr pomieszczenia" required autocomplete="nr_pomieszczenia" autofocus>
                                @error('no_room')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis wydarzenia') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text"  class="form-control @error('description') is-invalid @enderror" name="description" value="{{ session('description') }}" placeholder="Opis wydarzenia" required autocomplete="opis_wydarzenia" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ session('date_start') }}" placeholder="Data rozpoczęcia" required autocomplete="data_rozp" autofocus>
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
                                <input id="date_end" type="datetime-local" class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ session('date_end') }}" placeholder="Data zakończenia" required autocomplete="data_zak" autofocus>
                                @error('date_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="date_start_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia publikacji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_publi" type="datetime-local" class="form-control @error('date_start_publi') is-invalid @enderror" name="date_start_publi" value="{{ session('date_start_publi') }}" placeholder="Data rozpoczęcia publikacji" required autocomplete="data_roz_publikacji" autofocus>
                                @error('date_start_publi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="date_end_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia publikacji') }}</label>
                        <div class="col-md-6">
                            <input id="date_end_publi" type="datetime-local" class="form-control @error('date_end_publi') is-invalid @enderror" name="date_end_publi" value="{{ session('date_end_publi') }}" placeholder="Data zakończenia publikacji" required autocomplete="data_zak_publikacji" autofocus>
                            @error('date_end_publi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                        <div class="col-md-6">
                            <select id="status" class="form-control" name="statuses_id" required autofocus>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5    ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Utwórz') }}
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-primary">
                                    {{ __('Wróć') }}
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
<div class="footer">
    <p class="footer-text">@Sławek&Natan Company</p>
    </div>
@endsection
