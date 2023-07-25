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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {

        $currentDateTime = Carbon::now();

        $events = Event::where('date_start_publi', '<', $currentDateTime)
                   ->where('date_end_publi', '>', $currentDateTime)
                   ->whereNull('deleted_at')
                   ->with(['info' => function ($query) {
                    $query->whereNull('deleted_at');
                }])
                   ->paginate(2);
        return view('event.list', ['events' => $events]);
    }
    public function permissions(){
        $user_id = Auth::id(); 
        $usersRoleId = DB::table('event_services')
        ->where('users_id', $user_id)
        ->value('users_role_dictionary_id');
        if ($usersRoleId == 1){
            return 1;
        }
        elseif($usersRoleId==2) 
        {
         
            return 2;
        }  
        else{
            return 3;
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
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:45',
            'shortcut' => 'required|string|max:45',
            'city' => 'required|string|max:45',
            'street' => 'required|string|max:45',
            'zip_code' => 'required|string|max:45',
            'no_building' => 'nullable|integer',
            'no_room' => 'nullable|integer',
            'location_shortcut' => 'nullable|string|max:45',
            'description' => 'nullable|string',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after:date_start',
            'date_start_publi' => 'required|date|before:date_start',
            'date_end_publi' => 'required|date|after:date_start_publi|after_or_equal:date_end',
            'statuses_id' => 'required|integer', 
        ]);

        if ($validator->fails()) {
            return redirect('/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $locationShortcut = $request->input('city') . ', ' . $request->input('street') . ' ' . $request->input('no_building');
        $request->merge(['location_shortcut' => $locationShortcut]);
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
        if($hasPermission==1 || $hasPermission==2 ){
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
        $locationShortcut = $request->input('city') . ', ' . $request->input('street') . ' ' . $request->input('no_building');
        $request->merge(['location_shortcut' => $locationShortcut]);
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
        $currentDateTime = Carbon::now();

        EventDetails::where('events_id', $id)->update(['deleted_at' => $currentDateTime]);
        EventService::where('events_id', $id)->update(['deleted_at' => $currentDateTime]);
        Event::where('id', $id)->update(['deleted_at' => $currentDateTime]);
        

        return response() -> json([
            'status' => 'Twoje wydarzenie zostło usunięte'
    ]);
}
}





