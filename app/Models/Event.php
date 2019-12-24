<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'district_id',
        'vihara_id',
        'region_id',
        'name',
        'description',
        'address',
        'poster_url'
    ];

    public function vihara() {
        return $this->hasOne(Vihara::class);
    }
}
