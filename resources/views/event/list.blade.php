@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>WYDARZENIA</h1>
            </div>
            <div class="col-6">
                <a class="float-right" href="/create">
                    <button type="button" class="btn btn-primary">Dodaj</button>
                </a>
            </div>
        </div>
        @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">shortcut</th>
                <th scope="col">city</th>
                <th scope="col">street</th>
                <th scope="col">date_start</th>
                <th scope="col">date_end</th>
                <th scope="col">date_start_rek</th>
                <th scope="col">date_end_rek</th>
                <th scope="col">date_start_publi</th>
                <th scope="col">date_end_publi</th>
                <th scope="col">status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>
                    @if ($event->info->isNotEmpty())
                    <button class="btn btn-link show-details" data-id="{{ $event->id }}">></button>
                    @else
                    <button class="btn btn-link" disabled>></button>
                    @endif
                </td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->shortcut }}</td>
                <td>{{ $event->city }}</td>
                <td>{{ $event->street }}</td>
                <td>{{ $event->date_start }}</td>
                <td>{{ $event->date_end }}</td>
                <td>{{ $event->date_start_rek }}</td>
                <td>{{ $event->date_end_rek }}</td>
                <td>{{ $event->date_start_publi }}</td>
                <td>{{ $event->date_end_publi }}</td>
                <td>{{ $event->status->name }}</td>
                <td>
                    <select id="mySelect" onchange="if (this.value) window.location.href = this.value;">
                        <option value="" disabled selected>Wybierz</option>
                        <option value="{{ route('event.edit', $event->id) }}">Edycja</option>
                        <option value="{{ route('event.show', $event->id) }}">Podgląd</option>
                        <option value="">AM</option>
                        <option value="{{ route('create2', $event->id)}}">AE</option>




                    </select>
                </td>
                <td>
                    Usuwanie
                    <button class="btn btn-danger btn-sm delete" data-id="{{ $event->id }}">X</button>
                </td>
            </tr>
            @if ($event->info->isNotEmpty())
            <tr class="details">
                <td colspan="12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Imię prezentera</th>
                                <th>Nazwisko prezentera</th>
                                <th>Tytuł</th>
                                <th>Data rozpoczęcia</th>
                                <th>Data zakończenia</th>
                                <th>Opis</th>
                                <th>Komentarze</th>
                                <th>Liczba miejsc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->info as $info)
                            <tr>
                                <td>{{ $info->speaker_first_name }}</td>
                                <td>{{ $info->speaker_last_name }}</td>
                                <td>{{ $info->title }}</td>
                                <td>{{ $info->date_start }}</td>
                                <td>{{ $info->date_end }}</td>
                                <td>{{ $info->description }}</td>
                                <td>{{ $info->comments }}</td>
                                <td>{{ $info->number_seats }}</td>
                                <td>
                                    <select id="mySelect" onchange="if (this.value) window.location.href = this.value;">
                                        <option value="" disabled selected>Wybierz</option>
                                        <option value="">Edycja</option>
                                        <option value="">Podgląd</option>
                                    </select>
                                </td>
                                <td>
                                    Usuwanie
                                    <button class="btn btn-danger btn-sm delete" data-id="{{ $event->id }}">X</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    {{ $events->links() }}
</div>
</div>
@endsection


@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        jQuery(function($) {
            $('select').val('');
            $('.details').hide(); // Schowaj wszystkie podwydarzenia (details) na początku

            $('.show-details').click(function() {
                var detailsRow = $(this).closest('tr').next('.details');
                detailsRow.toggle(); // Pokaż/ukryj podwydarzenie po kliknięciu "Show details"
            });

            $('.show-details').each(function() {
                var eventRow = $(this).closest('tr');
                if (!eventRow.next('.details').length) {
                    $(this).prop('disabled', true);
                    $(this).removeClass('show-details'); // Usuń klasę show-details, jeśli brak podwydarzenia
                }
            });
            
            var selectElement = document.getElementById("mySelect");

// Zresetuj wartość do domyślnej po powrocie z trybu edycji lub podglądu
window.addEventListener("pageshow", function(event) {
  var historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
  if (historyTraversal) {
    selectElement.selectedIndex = 0;
  }
});
              // Pobierz element select
  var selectElement = document.getElementById("mySelect");

// Zresetuj wartość do domyślnej po opuszczeniu trybu edycji
selectElement.addEventListener("blur", function() {
  if (selectElement.value === "") {
    selectElement.selectedIndex = 0;
  }
});
            // Get the CSRF token from the meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('.delete').click(function() {
                var eventId = $(this).data("id");
                $.ajax({
                    method: "DELETE",
                    url: "http://szkola.test/event/" + eventId,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                    }
                })
                .done(function(response) {
                    alert("Success");
                    window.location.reload();
                })
                .fail(function(response) {
                    alert("Error");
                });
            });
        });
    </script>
@endsection
