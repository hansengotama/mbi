<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'vihara_id',
        'name',
        'description',
        'address',
        'date_from',
        'date_until',
        'poster_url'
    ];

    public function vihara() {
        return $this->hasOne(Vihara::class);
    }
}
