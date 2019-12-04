<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    protected $fillable = [
        'region_id',
        'name',
        'close_age',
        'buried_date',
        'deceased_date',
        'buried_at',
        'type',
        'photo_url'
    ];

    public function region() {
        $this->hasOne(Region::class);
    }
}
