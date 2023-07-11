<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\EventDetails;
use App\Models\EventStatus;
use App\Models\EventService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
       
        return view('event.list' ,
        [

        'events' => Event::paginate(2)

        ]);
    }
    public function permissions(){
        $user_id = Auth::id(); 
        $usersRoleId = DB::table('event_services')
        ->where('users_id', $user_id)
        ->value('users_role_dictionary_id');
        if ($usersRoleId == 1){
            return true;
        }
        else {
         
            return false;
        }  

    }
    public function showEventDetails($eventDetailsId)
    {
        $eventDetailsId=1;
        $eventDetails = EventDetails::find($eventDetailsId);
        $event = $eventDetails->info; // Powiązany model Event
    
        if ($event) {
            echo "Nazwa wydarzenia: " . $event->name;
            echo "Opis wydarzenia: " . $event->description;
            // Wyświetl inne informacje z modelu Event
        } else {
            echo "Brak powiązanego wydarzenia.";
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        return view('create',[
            'statuses'=>EventStatus::all()
          ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        
        $event = new Event($request->all());
        $event->save();
        $eventService = new EventService();
        $eventService->save();
        return redirect(route('event.list'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return View
     */
    public function show(Event $event):View
    {
        return view("event.show", [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
       * @param  Event $event
     * @return RedirectResponse
     */
    public function edit(Event $event)  
    {
        $hasPermission = $this->permissions();
        if($hasPermission){
            return view("event.edit", [
                'event' => $event,
                'statuses' => EventStatus::all(),
                'users'=>User::all()
            ]);
        }
        else{
            $error = 'Nie masz uprawnień do edycji.';
            return redirect()->route('event.list')->withErrors(['message' => $error]);
        }
        
           
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Event $event
     * @return RedirectResponse
     */
    public function update(Request $request, Event $event) :RedirectResponse
    {
        $event->fill($request->all());
        $event->save();
        return redirect(route('event.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EventDetails::where('events_id', $id)->delete();
        EventService::where('events_id', $id)->delete();
        
        $flight = Event::find($id);
        $flight -> delete();

        return response() -> json([
            'status' => 'success'
    ]);
}
}





