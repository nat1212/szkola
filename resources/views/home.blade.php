@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('css/list2.css')}}">
<link rel="stylesheet" href="{{asset('css/list.css')}}">
@endsection

@section('content')
<div class="container">
        <div class="col-md-12"> 
            <div class="card card-left">
            <div class="card-header">
                <span>{{ __('Twój profil') }}</span>
                <span class="toggle-icon2" onclick="toggleExpand()">⚙️</span>
            </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="col-6">
                <a class="float-right" href="/create">
                        <button type="button" class="btn btn-primary">Dodaj wydarzenie</button>
                    </a>
                </div>

                <div class="spacer"></div>

                <h4 class="expand-toggle" onclick="redirectToEventUserList()">Lista twoich wydarzeń:  <span class="toggle-icon">►</span></h4>

                    <div class="spacer"></div>

                    <h4 class="expand-toggle" onclick="redirectToEventList()">Lista wszystkich wydarzeń:  <span class="toggle-icon">►</span></h4>
     
                <div class="grid-wrapper2">

                <div class="container2">
                <div class="col-md-8">
                <div class="card mx-auto" style="width: 800px;">
    <div class="card-header">{{ __('Edycja Profilu') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('user.updateProfile', $user->id) }}">
            @csrf
           
            <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Imię') }}</label>

                            <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" placeholder="Imię" required autocomplete="Imię" autofocus>
                               
                             
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwisko') }}</label>

                            <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" placeholder="Nazwisko" required autocomplete="Nazwisko" autofocus>
                               
                             
                            </div>
                        </div>
            

           <div class="row mb-3">
                <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="cancelChanges()">Anuluj</button>
                </div>
            </div>
        </form>

        <div class="form-group row">
            <div class="col-md-8 offset-md-4">
                <a href="zmien-haslo" class="btn btn-primary">Zmień hasło</a>
            </div>
        </div>
    </div>
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
    




    <script>



function toggleExpand() {
    const gridWrapper2 = document.querySelector('.grid-wrapper2');
    if (gridWrapper2.style.display === 'block') {
        gridWrapper2.style.display = 'none';
    } else {
        gridWrapper2.style.display = 'block';
    }
}

function redirectToEventList() {
  window.location.href = "{{ route('event.list') }}";
}

function redirectToEventUserList() {
  window.location.href = "{{ route('user_list') }}";
}
document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = '{{ csrf_token() }}';
var updateProfileBtn = document.getElementById('updateProfileBtn');
    var formInputs = document.querySelectorAll('.tracked-field');

    var sexField = document.getElementById('sex');
    var birthDateField = document.getElementById('birth_date');

    var originalValues = {};

    formInputs.forEach(function(input) {
        originalValues[input.id] = input.value;

        input.addEventListener('input', function() {
            var anyFieldFilled = Array.from(formInputs).some(function(input) {
                return input.value.trim() !== '';
            });

            var anyValueChanged = Array.from(formInputs).some(function(input) {
                return input.value !== originalValues[input.id];
            });

            updateProfileBtn.disabled = !anyFieldFilled || !anyValueChanged;
        });
    });

    sexField.addEventListener('change', function() {
        updateProfileBtn.disabled = false;
    });

    birthDateField.addEventListener('input', function() {
        updateProfileBtn.disabled = false;
    });
});



document.getElementById('updateProfileBtn').addEventListener('click', function() {
    var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'flex';
});

document.getElementById('confirm-button').addEventListener('click', function() {
    var form = document.getElementById('updateProfileForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var updateMessage = document.getElementById('update-message');
                    updateMessage.textContent = response.message;
                    updateMessage.style.display = 'block'; 
                    setTimeout(function() {
                        updateMessage.style.display = 'none'; 
                        location.reload();
                    }, 1500); 
                } else {
                    alert('Wystąpił błąd podczas aktualizacji profilu.');
                }
            } else {
                alert('Wystąpił błąd podczas wysyłania żądania.');
            }
        }
    };

    xhr.open('POST', form.action);
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.send(formData);

    var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'none';
});

document.getElementById('cancel-button').addEventListener('click', function() {
    var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'none';
});




document.addEventListener('DOMContentLoaded', function() {
    var showDetailsButtons = document.querySelectorAll('.show-sub-event');

    showDetailsButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var dialog = document.getElementById('agreed2');
            dialog.style.display = 'flex';

            var description = this.closest('.event-wrapper').getAttribute('data-description');
            var descriptionElement = document.getElementById('eve_dese');
            descriptionElement.textContent = description;

            var cancelButton = document.getElementById('cancel2-button');

            cancelButton.addEventListener('click', function() {
                dialog.style.display = 'none';
            });
        });
    });
});

  

document.getElementById('leaveEventBtn').addEventListener('click', function(event) {
        event.preventDefault(); 

        var dialog = document.getElementById('leave-dialog');
        dialog.style.display = 'flex';

      
        var entryId = this.getAttribute('href').split('/').pop();
        dialog.setAttribute('data-entry-id', entryId);
    });

    document.getElementById('confirm-leave-button').addEventListener('click', function() {
        var dialog = document.getElementById('leave-dialog');
        dialog.style.display = 'none';

        var entryId = dialog.getAttribute('data-entry-id');

     
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/leave/' + entryId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                    var updateMessage = document.getElementById('update-message');
                    updateMessage.textContent = response.message;
                    updateMessage.style.display = 'block'; 
                    setTimeout(function() {
                        updateMessage.style.display = 'none'; 
                        location.reload();
                    }, 1500); 
                } else {
                    alert('Wystąpił błąd podczas aktualizacji profilu.');
                }
            } else {
                alert('Wystąpił błąd podczas wysyłania żądania.');
            }
        }
    };
        xhr.send();
        var dialog = document.getElementById('custom-dialog');
    dialog.style.display = 'none';
    });

    document.getElementById('cancel-leave-button').addEventListener('click', function() {
        var dialog = document.getElementById('leave-dialog');
        dialog.style.display = 'none';
    });



    function cancelChanges() {
    var firstNameInput = document.getElementById("first_name");
    firstNameInput.value = "{{ $user->first_name }}";
    
    var lastNameInput = document.getElementById("last_name");
    lastNameInput.value = "{{ $user->last_name }}";
    

    
  
    var updateProfileBtn = document.getElementById('updateProfileBtn');
   
}


</script>

@endsection
