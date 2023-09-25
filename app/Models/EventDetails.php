<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class EventDetails extends Model
{
    use HasFactory;

    protected $table ='event_details';

    protected $fillable = [
        'speaker_first_name',
        'speaker_last_name',
        'title',
        'date_start',
        'date_end',
        'description',
        'comments',
        'all_seats',
        'number_seats',
        'events_id',
        'date_start_rek',
        'date_end_rek',
        ];
      
    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }
}
