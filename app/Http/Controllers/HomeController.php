<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id(); 
        $currentDateTime = Carbon::now();
        $user = User::findOrFail($user_id);
        

        $yourEvents = DB::table('event_participants')
        ->join('events', 'event_participants.events_id', '=', 'events.id')
        ->join('event_details', 'event_participants.event_details_id', '=', 'event_details.id')
        ->where('event_participants.users_id', $user_id)
        ->whereNull('event_participants.deleted_at')
        ->whereNull('event_participants.number_of_people')
        ->select('event_details.title', 'event_details.date_start', 'event_details.date_end', 'event_details.speaker_first_name','event_details.speaker_last_name', 'event_details.description', 'event_participants.id','events.name','event_details.id')
        ->orderBy('event_details.date_start', 'asc')
        ->get();

        foreach ($yourEvents as $yourEvent) {
            $yourEvent->date_start = Carbon::parse($yourEvent->date_start);
            $yourEvent->date_end = Carbon::parse($yourEvent->date_end);
        }


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

        $groups = DB::table('event_participants')
        ->join('events', 'event_participants.events_id', '=', 'events.id')
        ->join('event_details', 'event_participants.event_details_id', '=', 'event_details.id')
        ->where('event_participants.users_id', $user_id)
        ->whereNull('event_participants.deleted_at')
        ->whereNotNull('event_participants.number_of_people')
        ->select('event_details.title', 'event_details.date_start', 'event_details.date_end', 'event_details.speaker_first_name','event_details.speaker_last_name','event_details.description', 'event_participants.id as participant_id','event_participants.number_of_people','event_details.id','event_participants.created_at','event_details.type')
        ->orderBy('event_details.date_start', 'asc')
        ->get();
    
        foreach ($groups as $group) {
            $group->date_start = Carbon::parse($group->date_start);
            $group->date_end = Carbon::parse($group->date_end);
        }
       
       /* $userEvents = DB::table('event_services')
        ->join('events', 'event_services.events_id', '=', 'events.id')
        ->where('event_services.users_id', $user_id)
        ->whereNull('event_services.deleted_at')
        ->where('event_services.date_start', '<', $currentDateTime)
        ->where('event_services.date_end', '>', $currentDateTime)
        ->select('events.*')
        ->get();
        
        foreach ($userEvents as $event) {
            $event->date_start = Carbon::parse($event->date_start);
            $event->date_end = Carbon::parse($event->date_end);
            $event->date_start_publi = Carbon::parse($event->date_start_publi);
            $event->date_end_publi = Carbon::parse($event->date_end_publi);
        }*/
        $userEvents = DB::table('event_services')
        ->where('event_services.users_id', $user_id)
        ->whereNull('event_services.deleted_at') 
        ->pluck('events_id');

        $events = Event::whereIn('id', $userEvents)
    ->with(['info' => function ($query) {
        $query->whereNull('deleted_at');
    }])
    ->get();
    foreach ($events as $event) {
        $event->date_start = Carbon::parse($event->date_start);
        $event->date_end = Carbon::parse($event->date_end);
        $event->date_start_rek = Carbon::parse($event->date_start_rek);
        $event->date_end_rek = Carbon::parse($event->date_end_rek);
        $event->date_start_publi =Carbon::parse($event->date_start_publi);
        $event->date_end_publi =Carbon::parse($event->date_end_publi);

        foreach($event->info as $info)
        {
            $info->date_start = Carbon::parse($info->date_start);
            $info->date_end = Carbon::parse($info->date_end);
            $info->date_start_rek = Carbon::parse($info->date_start_rek);
            $info->date_end_rek = Carbon::parse($info->date_end_rek);
            
        }}

        $userRole = DB::table('event_services')
        ->where('event_services.users_id', $user_id)
        ->value('users_role_dictionary_id');
    

        return view('home',['userEvents' => $events,'yourEvents'=>$yourEvents,"results"=>$results,'roles'=>$userRole,'user'=> $user,'groups'=>$groups
        ]);
    }
    public function changePassword()
    {
        return view('change-password');
    }
    public function zmienHaslo()
    {
        return view('zmien-haslo');
    }
public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            
            'new_password' => 'required|confirmed',
        ]);

        
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Stare hasło jest inne!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $userId=Auth::id(); 
        $user=User::find($userId);
        $action = 'Zmienił swoje hasło';
        Log::channel('php_file')->info('Użytkownik ' . $user->email . ': ' . $action);

        return back()->with("status", "Udało się ustawić nowe hasło!");
}
}
