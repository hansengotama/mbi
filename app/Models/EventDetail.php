<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDetail extends Model
{
    protected $fillable = [
        'event_id',
        'date_from',
        'date_until',
        'time_from',
        'time_until'
    ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
