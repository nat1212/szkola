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

                    {{ __('Witaj!')  }}</br>
                    Witaj! {{ session('status') }}
                    Stwórz wydarzenie-><a href="{{ url('/create') }}" >Kliknij tutaj</a></br>
                    <h4>Lista twoich wydarzeń oraz kto ma dostęp:</h4>
                    @foreach ($userEvents as $event)
                    <table>
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->shortcut }}</td>
                            <td>{{ $event->city }}</td>
                        </tr>
                        <tr class="details">
                <td colspan="12">
                    <table class="table table-striped">
                            <tr>
                            @foreach ($results as $result)
                            <td>{{ $result->email }}</td>
                            <td>{{ $result->date_start }}</td>
                            <td>{{ $result->date_end }}</td>
                            @endforeach
                            </tr>
                    </table>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
