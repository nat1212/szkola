<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use Illuminate\Http\Request;

class EventService extends Model
{
    use HasFactory;
    protected $table = 'event_services';

    protected $fillable = ['date_start', 'date_end', 'users_role_dictionary_id', 'events_id', 'users_id'];

    protected static function boot()
    {
    parent::boot();

    static::creating(function ($eventService) {
        if (!request()->has('additional_property')) {
            $eventService->date_start = now();  
            $eventService->date_end = now()->addYears(30); 
            $eventService->users_role_dictionary_id = 1; 
            $eventService->events_id = $eventService->getEventId(); 
            $eventService->users_id = auth()->user()->id; 
        }
    });
    }
    public function store(Request $request)
    {
    

    if (!request()->has('additional_property')) {
        $eventService = new EventService();
        $eventService->save();
    }

   
}


    protected function getEventId()
    {
        return Event::max('id');
    }
}
