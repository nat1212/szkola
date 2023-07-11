@extends('layouts.app')

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
                                <input id="name" type="text" class="form-control" name="name" value="{{ session('name') }}" placeholder="Nazwa" required autocomplete="nazwa" autofocus>

                             
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="shortcut" class="col-md-4 col-form-label text-md-end">{{ __('Skrot') }}</label>

                            <div class="col-md-6">
                                <input id="shortcut" type="text" class="form-control" name="shortcut" value="{{ session('shortcut') }}" placeholder="Skrot" required autocomplete="skrot" autofocus>

                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Miasto') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ session('city') }}" placeholder="Miasto" required autocomplete="miasto" autofocus>

                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="street" class="col-md-4 col-form-label text-md-end">{{ __('Ulica') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" value="{{ session('street') }}" placeholder="Ulica" required autocomplete="ulica" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-end">{{ __('Kod pocztowy') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ session('zip_code') }}" placeholder="Kod pocztowy" required autocomplete="kod_pocztowy" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_building" class="col-md-4 col-form-label text-md-end">{{ __('Nr budynku') }}</label>

                            <div class="col-md-6">
                                <input id="no_building" type="text" class="form-control" name="no_building" value="{{ session('no_building') }}" placeholder="Nr budynku" required autocomplete="nr_budynku" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_room" class="col-md-4 col-form-label text-md-end">{{ __('Nr pomieszczenia') }}</label>

                            <div class="col-md-6">
                                <input id="no_room" type="text" class="form-control" name="no_room" value="{{ session('no_room') }}" placeholder="Nr pomieszczenia" required autocomplete="nr_pomieszczenia" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="location_shortcut" class="col-md-4 col-form-label text-md-end">{{ __('Lokalizajca skrot') }}</label>

                            <div class="col-md-6">
                                <input id="location_shortcut" type="text" class="form-control" name="location_shortcut" value="{{ session('location_shortcut') }}" placeholder="Lokalizajca skrot" required autocomplete="lokalizajca_skrot" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis wydarzenia') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ session('description') }}" placeholder="Opis wydarzenia" required autocomplete="opis_wydarzenia" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control" name="date_start" value="{{ session('date_start') }}" placeholder="Data rozpoczęcia" required autocomplete="data_rozp" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local" class="form-control" name="date_end" value="{{ session('date_end') }}" placeholder="Data zakończenia" required autocomplete="data_zak" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start_rek" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_rek" type="datetime-local" class="form-control" name="date_start_rek" value="{{ session('date_start_rek') }}" placeholder="Data rozpoczęcia rejestracji" required autocomplete="data_roz_rejestr" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end_rek" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_end_rek" type="datetime-local" class="form-control" name="date_end_rek" value="{{ session('date_end_rek') }}" placeholder="Data zakończenia rejestracji" required autocomplete="data_zak_rejestr" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia publikacji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_publi" type="datetime-local" class="form-control" name="date_start_publi" value="{{ session('date_start_publi') }}" placeholder="Data rozpoczęcia publikacji" required autocomplete="data_roz_publikacji" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="date_end_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia publikacji') }}</label>
                        <div class="col-md-6">
                            <input id="date_end_publi" type="datetime-local" class="form-control" name="date_end_publi" value="{{ session('date_end_publi') }}" placeholder="Data zakończenia publikacji" required autocomplete="data_zak_publikacji" autofocus>
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
                                    {{ __('Stwórz') }}
                                </button>
                                <a href="{{ route('event.list') }}" class="btn btn-primary">
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
@endsection
