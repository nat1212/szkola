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
       
        $userEvents = DB::table('event_services')
        ->join('events', 'event_services.events_id', '=', 'events.id')
        ->where('event_services.users_id', $user_id)
        ->whereNull('event_services.deleted_at')
        ->where('event_services.date_start', '<', $currentDateTime)
        ->where('event_services.date_end', '>', $currentDateTime)
        ->select('events.*')
        ->get();
        
        $userRole = DB::table('event_services')
        ->where('event_services.users_id', $user_id)
        ->value('users_role_dictionary_id');
    

        return view('home',['userEvents' => $userEvents,"results"=>$results,'roles'=>$userRole,'user'=> $user
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
