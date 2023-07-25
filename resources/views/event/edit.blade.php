@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edycja') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('create.update',$event->id)}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $event->name }}" placeholder="Nazwa" required autocomplete="nazwa" autofocus>

                             
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="shortcut" class="col-md-4 col-form-label text-md-end">{{ __('Skrot') }}</label>

                            <div class="col-md-6">
                                <input id="shortcut" type="text" class="form-control" name="shortcut" value="{{ $event->shortcut }}" placeholder="Skrot" required autocomplete="skrot" autofocus>

                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Miasto') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{$event->city }}" placeholder="Miasto" required autocomplete="miasto" autofocus>

                             
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="street" class="col-md-4 col-form-label text-md-end">{{ __('Ulica') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" value="{{$event->street }}" placeholder="Ulica" required autocomplete="ulica" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-end">{{ __('Kod pocztowy') }}</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{$event->zip_code }}" placeholder="Kod pocztowy" required autocomplete="kod_pocztowy" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_building" class="col-md-4 col-form-label text-md-end">{{ __('Nr budynku') }}</label>

                            <div class="col-md-6">
                                <input id="no_building" type="text" class="form-control" name="no_building" value="{{ $event->no_building }}" placeholder="Nr budynku" required autocomplete="nr_budynku" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_room" class="col-md-4 col-form-label text-md-end">{{ __('Nr pomieszczenia') }}</label>

                            <div class="col-md-6">
                                <input id="no_room" type="text" class="form-control" name="no_room" value="{{ $event->no_room }}" placeholder="Nr pomieszczenia" required autocomplete="nr_pomieszczenia" autofocus>

                             
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Opis wydarzenia') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ $event->description }}" placeholder="Opis wydarzenia" required autocomplete="opis_wydarzenia" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_start" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="datetime-local" class="form-control" name="date_start" value="{{ $event-> date_start}}" placeholder="Data rozpoczęcia" required autocomplete="data_rozp" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="datetime-local" class="form-control" name="date_end" value="{{$event->date_end }}" placeholder="Data zakończenia" required autocomplete="data_zak" autofocus>

                             
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="date_start_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data rozpoczęcia publikacji') }}</label>

                            <div class="col-md-6">
                                <input id="date_start_publi" type="datetime-local" class="form-control" name="date_start_publi" value="{{ $event->date_start_publi }}" placeholder="Data rozpoczęcia publikacji" required autocomplete="data_roz_publikacji" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date_end_publi" class="col-md-4 col-form-label text-md-end">{{ __('Data zakończenia publikacji') }}</label>

                            <div class="col-md-6">
                                <input id="date_end_publi" type="datetime-local" class="form-control" name="date_end_publi" value="{{$event->date_end_publi }}" placeholder="Data zakończenia publikacji" required autocomplete="data_zak_publikacji" autofocus>

                             
                            </div>
                        </div>
                        <div class="row mb-3">
                    <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

    <div class="col-md-6">
        <select id="status" class="form-control" name="statuses_id" required autofocus>
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ $event->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
    
</div>

<div class="row mb-2">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Edytuj') }}
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
</div>
@endsection
