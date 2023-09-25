<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;
    protected $table ='event_participants';
    protected $fillable = [
        'date_report',
        'date_approval',
        'date_confirmation',
        'number_of_people',
        'comments',
        'dictionary_schools_id',
        'participants_id',
        'users_id',
        'events_id',
        'event_details_id',
    ];
    public function eventParticipantLists()
    {
        return $this->hasMany(eventParticipantList::class, 'event_participants_id');
    }
}
