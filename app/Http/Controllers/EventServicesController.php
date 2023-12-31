<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventService;
use App\Models\User;
use App\Models\Event;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Controllers\EventController;

class EventServicesController extends Controller
{
  private function validateEventData(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'date_start' => 'required|date', 
      'date_end' => 'required|date|after:date_start', 
     
  ]);
  
      return $validator;
  }
  

    public function addMember($id)
    {
      $eventControllerInstance = new EventController();
      $hasPermission = $eventControllerInstance->permissions($id);
      if($hasPermission !== null &&($hasPermission==1 || $hasPermission==2)){
      $date = Event::find($id);
        return view('addMember',[
            'event' => $id,
            'date'=>$date,
            'roles'=>UserRole::all(),
            'users'=>User::all()
              
          ]);}
          else{
            $error = 'Nie masz uprawnień do dodania współpracownika.';
            return redirect()->route('home')->withErrors(['message' => $error]);
        }
    }
    public function store(Request $request):RedirectResponse
      {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $error = 'Nie ma podanego użytkownika.';
            return redirect()->back()->withErrors(['message' => $error]);
            
        }
        
        $users_id = $user->id;
        $request->merge(['users_id' => $users_id]);

        
        $checkId = $request->users_id;
        $event=$request->events_id;
        $count = EventService::where('users_id', $checkId)
                      ->where('events_id', $event)
                      ->whereNull('deleted_at')
                      ->count();
        if ($count>0) {
          $error = 'Podany użytkownik ma już uprawnienia.';
          return redirect()->back()->withErrors(['message' => $error]);
        }

        
              

        $validator = $this->validateEventData($request);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $userId=Auth::id(); 
        $user=User::find($userId);
        $action = 'Dodał użytkownika o id: ';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action .$request->users_id.' do wydarzenia o id: '.$request->events_id.' nadajac mu role o id: '.$request->users_role_dictionary_id );
        
        EventService::create($request->all());
          return redirect('home');
          
      }
      public function updateData(Request $request, $id)
    {

      $eventControllerInstance = new EventController();
      $eventService = EventService::find($id);
      $event_id = $eventService->events_id;

      $hasPermission = $eventControllerInstance->permissions($event_id);
      if($hasPermission !== null &&($hasPermission==1 || $hasPermission==2)){
        $validatedData = $request->validate([
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'selected_role' => 'required|numeric',
            // Dodaj inne pola do walidacji
        ]);

        // Pobierz rekord do aktualizacji
        $record = EventService::find($id);

        // Aktualizuj dane rekordu
        $record->date_start = $validatedData['date_start'];
        $record->date_end = $validatedData['date_end'];
        $record->users_role_dictionary_id = $validatedData['selected_role'];
        // Aktualizuj inne pola

        // Zapisz zmiany w bazie danych
        $record->save();

        return redirect()->back()->with('success', 'Dane zostały zaktualizowane.');
      }else{
        return redirect()->back()->with('error', 'Nie masz uprawnień.');
      }
    }

      public function destroy($id)
    {

        $currentDateTime = Carbon::now();
        $memberId = EventService::where('id', $id)->pluck('users_id')->first();
        $eventId = EventService::where('id', $id)->pluck('events_id')->first();
        

        $eventControllerInstance = new EventController();
        
  
        $hasPermission = $eventControllerInstance->permissions($eventId);
        if($hasPermission !== null &&($hasPermission==1 || $hasPermission==2)){
        EventService::where('id', $id)->update(['deleted_at' => $currentDateTime]);
        
        $userId=Auth::id(); 
        $user=User::find($userId);
        $action = 'Zabrał upoważnienie użytkownikowi o id';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action.': '.$memberId.' dla wydarzenia o id:'.$eventId );

        return response() -> json([
            'status' => 'Zabrałeś uprawnienia'
    ]);
    }else{
      return redirect()->back()->with('error', 'Nie masz uprawnień.');
    }
  }



    
}
