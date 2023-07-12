<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventService;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EventServicesController extends Controller
{
    public function addMember($id) : View
    {
        return view('addMember',[
            'event' => $id,
            'roles'=>UserRole::all(),
            'users'=>User::all()
              
          ]);
    }
    public function store(Request $request):RedirectResponse
      {
        EventService::create($request->all());
          return redirect('home');
          
      }
    
}
