@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="{{asset('css/footer.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zapis grupowy na wydarzenie:')}}   {{$event_details_title}} </div>

                <div class="card-body">
                <div class="des2">Uwaga!</div>
                <div class="des">W tym zapisie jeśli pole imię oraz nazwisko nie jest wypełnione to program tego nie liczy!</div>
              <div class="container2">
    <div class="center-align">
        <label for="number_input">Dostępne miejsca:</label>
        <span id="available_seats">{{ $seats }} </span>
    </div>



    
    <div class="center-align">
        <div class="input-group">
        <input type="hidden" name="numeric_only" value="{{ $type }}">
            <input id="number_input" class="form-control" type="number" placeholder="Dodaj osoby" min="1">
            <div class="input-group-append">
                <button style ="margin-left:10px;" onclick="addInputss()" class="btn btn-primary" id="addPeopleButton">Dodaj</button>
            </div>
        </div>
      
    </div>
    <div id="update-message2" class="alert" style="display: none;"></div>
</div>

                    <form method="POST" action="/zapisz" onsubmit="return validateForm();">
                        @csrf

                        <div class="row mb-3"></div>

<div id="participantInputs"></div>
                     
                   
                       
                        <input type="hidden" name="event_details_id" value="{{ $event_details_id }}">

                        <div class="row mb-0 mt-4">
                            <div class="col-md-6 offset-md-5    ">
                            <button type="submit" class="btn btn-primary" id="submitButton" disabled>
    {{ __('Zapisz') }}
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
</div>
<div class="footer">
    <p class="footer-text">@Sławek&Natan Company</p>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const firstNameInputs = document.querySelectorAll("input[name^='first_name']");
        const lastNameInputs = document.querySelectorAll("input[name^='last_name']");
        const addButton = document.getElementById('addButton');
        
        firstNameInputs.forEach(function(input, index) {
            input.addEventListener("input", function() {
                countParticipants();
            });
        });

        lastNameInputs.forEach(function(input, index) {
            input.addEventListener("input", function() {
                countParticipants();
            });
        });

        function countParticipants() {
            const totalParticipants = Array.from(firstNameInputs).filter(input => input.value.trim() !== "").length;
            const numberInput = document.querySelector("input[name='number_of_people']");
            numberInput.value = totalParticipants;
           
        }
        countParticipants();
    });
</script>
<script>
    let counter = 0; 
function addInputss() {
    const numberInput = document.getElementById("number_input");
    const numberOfInputsToAdd = parseInt(numberInput.value);

    const updateMessage = document.getElementById('update-message2');
    const availableSeatsElement = document.getElementById('available_seats');
    const participantInputs = document.getElementById('participantInputs'); 
    const submitButton = document.getElementById("submitButton");



    numberInput.addEventListener("input", function() {
        const numberOfInputsToAdd = parseInt(numberInput.value);
 

        if (!isNaN(numberOfInputsToAdd) && numberOfInputsToAdd > 0 ) {
            submitButton.removeAttribute("disabled");
        }
    });

    // Initially check the input value
    numberInput.dispatchEvent(new Event("input"));


    if (isNaN(numberOfInputsToAdd) || numberOfInputsToAdd <= 0) {
        updateMessage.textContent = "Proszę wprowadzić poprawną liczbę większą od zera.";
        updateMessage.style.display = 'block';

        setTimeout(function () {
            updateMessage.style.display = 'none';
        }, 3000);

        return;
    }

    const currentAvailableSeats = parseInt(availableSeatsElement.textContent);

    if (numberOfInputsToAdd > currentAvailableSeats) {
        updateMessage.textContent = "Nie można dodać więcej osób niż dostępnych miejsc.";
        updateMessage.style.display = 'block';

        setTimeout(function () {
            updateMessage.style.display = 'none';
        }, 3000);

        return;
    }

   
    const newAvailableSeats = currentAvailableSeats - numberOfInputsToAdd;
    availableSeatsElement.textContent = newAvailableSeats;

    numberInput.value = "";

    for (let i = 0; i < numberOfInputsToAdd; i++) {
        counter++;
        const participantDiv = document.createElement("div");
        participantDiv.className = "row mb-2";

     
        const numerationLabel = document.createElement("label");
   numerationLabel.className = "col-md-1 numeracja-label";
        numerationLabel.textContent = counter + ".";

        const divCol1 = document.createElement("div");
        divCol1.className = "col-md-5";

        const firstNameInput = document.createElement("input");
        firstNameInput.className = "form-control @error('city') is-invalid @enderror";
        firstNameInput.type = "text";
        firstNameInput.name = "first_name" + counter;
        firstNameInput.placeholder = "Imię";

        divCol1.appendChild(firstNameInput);

        const divCol2 = document.createElement("div");
        divCol2.className = "col-md-5";

        const lastNameInput = document.createElement("input");
        lastNameInput.className = "form-control @error('city') is-invalid @enderror";
        lastNameInput.type = "text";
        lastNameInput.name = "last_name" + counter;
        lastNameInput.placeholder = "Nazwisko";


        divCol2.appendChild(lastNameInput);

     
        participantDiv.appendChild(numerationLabel);
        participantDiv.appendChild(divCol1);
        participantDiv.appendChild(divCol2);

        participantInputs.appendChild(participantDiv);

       
    }

 
    const number_of_people = document.getElementById("number_of_people");
    const totalParticipants = parseInt(number_of_people.value) + numberOfInputsToAdd;
    number_of_people.value = totalParticipants;

    
}
function validateForm() {
    const firstNameInputs = document.querySelectorAll("input[name^='first_name']");
    const lastNameInputs = document.querySelectorAll("input[name^='last_name']");

    const firstNameFilled = Array.from(firstNameInputs).some(input => input.value.trim() !== "");
    const lastNameFilled = Array.from(lastNameInputs).some(input => input.value.trim() !== "");

    if (!(firstNameFilled && lastNameFilled)) {
        const updateMessage = document.getElementById('update-message2');
        updateMessage.textContent = "Proszę wypełnić oba pola Imię i Nazwisko.";
        updateMessage.style.display = 'block';

        setTimeout(function () {
            updateMessage.style.display = 'none';
        }, 3000);

        return false;
    }

    return true;
}

</script>
@endsection