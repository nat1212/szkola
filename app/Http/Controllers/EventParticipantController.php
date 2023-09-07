<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\View\View;
use App\Models\EventParticipant;
use App\Models\EventParticipantList;
use App\Models\EventDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventParticipantController extends Controller
{
    public function zapisz($id) : View
    {   
        $event = EventDetails::find($id);
        return view('zapisz',[
           'event_details_id'=>$id,
          ]);
    }
    public function list($id){
        $eventParticipants = EventParticipantList::select('first_name', 'last_name')
    ->join('event_participants', 'event_participant_lists.event_participants_id', '=', 'event_participants.id')
    ->where('event_participants.event_details_id', $id)
    ->get();

    $Numberseats = EventDetails::find($id)->number_seats;
    return view('list',[
        'event_details_id'=>$id,
        'names'=>$eventParticipants,
        'seats'=>$Numberseats,
       ]);
    }
    public function freeSeets($id,$registrationCount){
       
        

        $eventDetails = EventDetails::find($id);

       

        $availableSeats = $eventDetails->number_seats - $registrationCount;

        if($availableSeats < 0)
        {
            return 0;

        }
        else{
            return 1;
        }
    }
    
    public function store(Request $request){

        $participants = [];
        for ($i = 1; $i <= 10; $i++) {
            $first_name_key = "first_name{$i}";
            $last_name_key = "last_name{$i}";
    
            $first_name = $request->input($first_name_key);
            $last_name = $request->input($last_name_key);
    
            // Sprawdź, czy oba pola Imie i nazwisko są wypełnione
            if ($first_name && $last_name) {
                $participants[] = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                ];
            }
        }
        if(count($participants)==0)
        {
            return redirect()->route('user_list');
        }
        $event_details_id = $request->input('event_details_id');
        $events_id = EventDetails::find($event_details_id)->events_id;
        
        $NumberParticipants=count($participants);

        $result=$this->freeSeets($event_details_id,$NumberParticipants);
        if($result==1){
            $eventParticipant = new EventParticipant();
            $eventParticipant->date_report = now(); // Ustawiamy datę raportu na aktualną datę
            $eventParticipant->date_approval = null; // Ustawiamy datę zatwierdzenia na null
            $eventParticipant->number_of_people = count($participants);
            $eventParticipant->comments = null;
            $eventParticipant->dictionary_schools_id =null;
            $eventParticipant->participants_id = null;
            $eventParticipant->events_id = $events_id;
            $eventParticipant->event_details_id = $event_details_id;
        
            
            $eventParticipant->save();
            $eventDetails = EventDetails::find($event_details_id);
            $eventDetails->number_seats -= $NumberParticipants;
            $eventDetails->save();
            $eventParticipantId = $eventParticipant->id;
           
    
            foreach ($participants as $participantData){
                $eventParticipantList = new EventParticipantList();
                $eventParticipantList->event_participants_id=$eventParticipantId;
                $eventParticipantList->first_name= $participantData['first_name'];
                $eventParticipantList->last_name=$participantData['last_name'];
                $eventParticipantList->save();
                
            }
            
            return redirect()->route('user_list');
        }
        else{
                 $error = 'Nie ma już wolnych miejsc.';
                return redirect()->route('user_list')->withErrors(['message' => $error]);
        }
      
    }
    
}
