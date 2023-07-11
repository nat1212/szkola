<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Event2;
use App\Models\EventDetails;
use Illuminate\Contracts\View\View;

class Event2Controller extends Controller
{
  public function create2() : View
  {
      return view('create2',[
          'details'=>EventDetails::all()
        ]);
  }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *@return RedirectResponse
     */
    public function store(Request $request):RedirectResponse
    {
        Event2::create($request->all());
        return redirect('home');
        
    }
}
