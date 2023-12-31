<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipantList extends Model
{
    use HasFactory;
    protected $table ='event_participant_lists';
    protected $fillable = [
        'first_name',
        'last_name',
        'event_participants_id',
    ];
    public function list()
    {
        return $this->belongsTo(eventParticipant::class, 'event_participants_id');
    }
}
