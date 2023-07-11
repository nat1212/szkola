@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Podgląd') }}</div>

                <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $event->name }}" disabled>

                             
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="shortcut" class="col-md-4 col-form-label text-md-end">{{ __('Skrot') }}</label>

                            <div class="col-md-6">
                                <input id="shortcut" type="text" class="form-control" name="shortcut" value="{{ $event->shortcut }}" disabled>

                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Miasto') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{$event->city }}" disabled>

                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="street" class="col-md-4 col-form-label text-md-end">{{ __('Ulica') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" value="{{$event->street }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-end">{{ __('Kod pocztowy') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{$event->zip_code }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_building" class="col-md-4 col-form-label text-md-end">{{ __('Nr budynku') }}</label>

                            <div class="col-md-6">
                                <input id="no_building" type="text" class="form-control" name="no_building" value="{{ $event->no_building }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_room" class="col-md-4 col-form-label text-md-end">{{ __('Nr pomieszczenia') }}</label>

                            <div class="col-md-6">
                                <input id="no_room" type="text" class="form-control" name="no_room" value="{{ $event->no_room }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="location_shortcut" class="col-md-4 col-form-label text-md-end">{{ __('Lokalizajca skrot') }}</label>

                            <div class="col-md-6">
                                <input id="location_shortcut" type="text" class="form-control" name="location_shortcut" value="{{ $event->location_shortcut }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis wydarzenia') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $event->description }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control" name="date_start" value="{{ $event-> date_start}}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local" class="form-control" name="date_end" value="{{$event->date_end }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start_rek" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_rek" type="datetime-local" class="form-control" name="date_start_rek" value="{{ $event->date_start_rek }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end_rek" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia rejestracji') }}</label>

                            <div class="col-md-6">
                                <input id="date_end_rek" type="datetime-local" class="form-control" name="date_end_rek" value="{{$event->date_end_rek }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia publikacji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_publi" type="datetime-local" class="form-control" name="date_start_publi" value="{{ $event->date_start_publi }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia publikacji') }}</label>

                            <div class="col-md-6">
                                <input id="date_end_publi" type="datetime-local" class="form-control" name="date_end_publi" value="{{$event->date_end_publi }}" disabled>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control" name="status" value="{{ $event->status->name }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5">
                            <a href="{{route('event.list')}}">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Wróć') }}
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
