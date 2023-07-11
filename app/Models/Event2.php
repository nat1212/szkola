<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event2 extends Model
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
        'number_seats',
        'events_id',
        ];
            /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $attributes = [
        'events_id' => '1',
    ];
    public function info()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }
}
