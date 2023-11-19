<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\EventDetails;
use App\Models\Event;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;


class EventDetailsController extends Controller
{
  private function validateEventData(Request $request)
{
  $validator = Validator::make($request->all(), [
    'speaker_first_name' => 'required|string|max:255',
    'speaker_last_name' => 'required|string|max:255',
    'title' => 'required|string|max:255',
    'date_start' => 'required|date|after_or_equal:event_start',
    'date_end' => 'required|date|after:date_start|before:event_end',
    'description' => 'required|string',
    'comments' => 'required|string',
    'number_seats' => 'required|integer|min:1', 
    'date_start_rek' => 'required|date|before:date_start',
    'date_end_rek' => 'required|date|after:date_start_rek|before:date_start', 
]);

    return $validator;
}
   
    
    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return View
     */
    public function create2($id)
    {
      $eventControllerInstance = new EventController();
      $hasPermission = $eventControllerInstance->permissions($id);
      if($hasPermission==1||$hasPermission==2||$hasPermission==3){
        $event = Event::find($id);
        return view('create2',[
            'event' => $event
          ]);
        }
        else{
          $error = 'Nie masz uprawnień!';
          return redirect()->route('home')->withErrors(['message' => $error]);
      }
    }
      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       *@return RedirectResponse
       */
      public function store(Request $request):RedirectResponse
      {
        $validator = $this->validateEventData($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $all_seats = $request->input('number_seats');
        
      
        $request->merge(['all_seats' => $all_seats]);
        EventDetails::create($request->all());

        $userId=Auth::id(); 
        $user=User::find($userId);
        $action = 'Utworzył pod wydarzenie dla wydarzenia o id';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action.': '.$request->events_id );
          
        return redirect()->route('home');
          
      }


        /**
     * Show the form for editing the specified resource.
     *
       * @param  EventDetails $event
     * @return RedirectResponse
     */
    public function edit(EventDetails $event)  
    {
      $eventControllerInstance = new EventController();
      $hasPermission = $eventControllerInstance->permissions($event->events_id);
      if($hasPermission==1||$hasPermission==2||$hasPermission==3){ 
      $eventId = $event->events_id;
      $date = Event::find($eventId);
        return view("event.edit_details", [
        'event' => $event,
        'date'=>$date,
        ]);}
        else{
          $error = 'Nie masz uprawnień!';
          return redirect()->route('home')->withErrors(['message' => $error]);
      }
    }
      /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Event $event
     * @return RedirectResponse
     */
    public function update(Request $request, EventDetails $event) :RedirectResponse
    {
      $validator = $this->validateEventData($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $event->fill($request->all());
        $event->save();
        $userId=Auth::id(); 
        $user=User::find($userId);
        $action = 'Edytował pod wydarzenie o id';
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
      $eventDetails = EventDetails::find($id);

      $eventControllerInstance = new EventController();
      $hasPermission = $eventControllerInstance->permissions($eventDetails->events_id);
      if($hasPermission==1||$hasPermission==2||$hasPermission==3){
        $currentDateTime = Carbon::now();
        EventDetails::where('id', $id)->update(['deleted_at' => $currentDateTime]);
      
        
        $userId=Auth::id(); 
        $user=User::find($userId);
        $action = 'Usunął pod wydarzenie o id';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action.': '.$id );

        return response() -> json([
            'status' => 'Twoje pod wydarzenie zostło usunięte'
    ]);}
    else{
      $error = 'Nie masz uprawnień!';
      return redirect()->route('home')->withErrors(['message' => $error]);
  }
  }
  
}
