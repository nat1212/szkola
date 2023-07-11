<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
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
        $userEvents = DB::table('events')
        ->join('event_services', 'events.id', '=', 'event_services.events_id')
        ->join('users', 'users.id', '=', 'event_services.users_id')
        ->select('events.name as event_name', 'users.email', 'event_services.date_start', 'event_services.date_end')
        ->whereIn('event_services.events_id', function ($query) use ($user_id) {
            $query->select('events_id')
                ->from('event_services')
                ->where('users_id', $user_id);
        })
        ->skip(1)
        ->take(15)
        ->get();
        
        

        return view('home',['userEvents' => $userEvents
        ]);
    }
    public function changePassword()
{
   return view('change-password');
}
public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            
            'new_password' => 'required|confirmed',
        ]);

        
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
}
}
