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
use Illuminate\Support\Facades\Log;



class EventController extends Controller
{



    private function validateEventData(Request $request)
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
            'date_start_publi' => 'required|date|before_or_equal:date_start',
            'date_end_publi' => 'required|date|after:date_start_publi|after_or_equal:date_end',
            'statuses_id' => 'required|integer', 
        ]);
   
    
        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request):View
    {

        $currentDateTime = Carbon::now();
        $specificEventId = null;

        if ($request->has('specific_event_id')) {
            $specificEventId = $request->input('specific_event_id');
        }

        $events = Event::where('date_start_publi', '<', $currentDateTime)
                   ->where('date_end_publi', '>', $currentDateTime)
                   ->whereNull('deleted_at')
                   ->where('statuses_id',1)
                   ->with(['info' => function ($query) {
                    $query->whereNull('deleted_at');
                }])//po co to bylo xD
                   ->paginate(2);
        return view('event.list', ['events' => $events,'specificEventId' => $specificEventId]);
    }
    public function permissions(){
        $user_id = Auth::id(); 
        $currentDateTime = Carbon::now();
        $usersRoleId = DB::table('event_services')
        ->where('users_id', $user_id)
        ->where('date_start', '<', $currentDateTime)
        ->where('date_end', '>', $currentDateTime)
        ->whereNull('deleted_at')
        ->value('users_role_dictionary_id');
        if ($usersRoleId == 1){
            return 1;
        }
        elseif($usersRoleId==2) 
        {
         
            return 2;
        }  
        elseif($usersRoleId==3){
            return 3;
        }
        else{
            return 4;
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
    public function user_list()
    {
        
        $user_id = Auth::id(); 
        $currentDateTime = Carbon::now();

        $userEvents = DB::table('event_services')
        ->join('events', 'event_services.events_id', '=', 'events.id')
        ->where('event_services.users_id', $user_id)
        ->whereNull('event_services.deleted_at')
        ->where('event_services.date_start', '<', $currentDateTime)
        ->where('event_services.date_end', '>', $currentDateTime)
        ->select('events.*')
        ->get();


        $results = DB::table('events')
        ->join('event_services', 'events.id', '=', 'event_services.events_id')
        ->join('users', 'users.id', '=', 'event_services.users_id')
        ->select('event_services.id','event_services.users_role_dictionary_id','events.name as event_name', 'users.email', 'event_services.date_start', 'event_services.date_end')
        ->whereIn('event_services.events_id', function ($query) use ($user_id) {
            $query->select('events_id')
                ->from('event_services')
                ->where('users_id', $user_id);
        })
        ->whereNull('event_services.deleted_at')
        ->where('event_services.date_start', '<', $currentDateTime)
        ->where('event_services.date_end', '>', $currentDateTime)
        ->where('users_id', '!=', $user_id)
        ->take(15)
        ->get();

        $events = EventDetails::all();
        return view('user_list',[
            'userEvents'=>$userEvents,
            'results'=>$results,
            'event'=>$events,
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
        
    
        $validator = $this->validateEventData($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $locationShortcut = $request->input('city') . ', ' . $request->input('street') . ' ' . $request->input('no_building');
        $request->merge(['location_shortcut' => $locationShortcut]);
        $event = new Event($request->all());
        $event->save();
        $eventService = new EventService();
        $eventService->save();

        $id=Auth::id(); 
        $user=User::find($id);
        $action = 'Utworzył wydarzenie';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action);

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
        $validator = $this->validateEventData($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $locationShortcut = $request->input('city') . ', ' . $request->input('street') . ' ' . $request->input('no_building');
        $request->merge(['location_shortcut' => $locationShortcut]);
        $event->fill($request->all());
        $event->save();

        $id=Auth::id(); 
        $user=User::find($id);
        $action = 'Edytował wydarzenie o id';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action.': '.$event->id );

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
        $hasPermission = $this->permissions();
        if($hasPermission==1){
            $currentDateTime = Carbon::now();

            EventDetails::where('events_id', $id)->update(['deleted_at' => $currentDateTime]);
            EventService::where('events_id', $id)->update(['deleted_at' => $currentDateTime]);
            Event::where('id', $id)->update(['deleted_at' => $currentDateTime]);
            $userId=Auth::id(); 
            $user=User::find($userId);
            $action = 'Usunął wydarzenie o id';
            Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action.': '.$id );

            return response() -> json([
                'status' => 'Twoje wydarzenie zostło usunięte'
    ]);
    }
    else{
        $error = 'Nie masz uprawnień do usunięcia.';
        return redirect()->route('event.list')->withErrors(['message' => $error]);

    }
    }
}





