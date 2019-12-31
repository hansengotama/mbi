<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    protected $fillable = [
        'district_id',
        'region_id',
        'name',
        'close_age',
        'buried_date',
        'deceased_date',
        'buried_at',
        'type',
        'photo_url'
    ];

    protected $appends = [
        'photo_full_url'
    ];

    public function getPhotoFullUrlAttribute()
    {
        return url('/').'/storage/'.$this->photo_url;
    }

    public function region() {
        $this->hasOne(Region::class);
    }
}
