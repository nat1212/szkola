@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Konto') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Jestes zalogowany! ') }}</br>
                    Witaj! {{ session('status') }}
                    Stwórz wydarzenie-><a href="{{ url('/create') }}" >Kliknij tutaj</a></br>
                    <h4>Lista twoich wydarzeń oraz kto ma dostęp:</h4>
                    @foreach ($userEvents as $key => $event)
                    @if ($key === 0)

                    <p>{{ $event->event_name }}</p>
                    @endif
                    <p>{{ $event->email}}</p>
                    <p>{{ $event->date_start}}</p>
                    <p>{{ $event->date_end}}</p></br>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
