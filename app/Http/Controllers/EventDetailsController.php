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


class EventDetailsController extends Controller
{
   
    
    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return View
     */
    public function create2($id) : View
    {
        $event = Event::find($id);
        return view('create2',[
            'event' => $event
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

        $validator = Validator::make($request->all(), [
            'speaker_first_name' => 'required|string|max:255',
            'speaker_last_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'date_start' => 'required|date|after:event_start',
            'date_end' => 'required|date|after:date_start|before:event_end',
            'description' => 'required|string',
            'comments' => 'required|string',
            'number_seats' => 'required|integer|min:1', 
            'date_start_rek' => 'required|date|before:date_start',
            'date_end_rek' => 'required|date|after:date_start_rek|before:date_start', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        EventDetails::create($request->all());
          
        return redirect()->route('event.list');
          
      }


        /**
     * Show the form for editing the specified resource.
     *
       * @param  Event $event
     * @return RedirectResponse
     */
    public function edit(EventDetails $event)  
    {
        
      
        return view("event.edit_details", [
        'event' => $event,
        ]);
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
        EventDetails::where('id', $id)->update(['deleted_at' => $currentDateTime]);
      
        

        return response() -> json([
            'status' => 'Twoje pod wydarzenie zostło usunięte'
    ]);
  }
  
}
