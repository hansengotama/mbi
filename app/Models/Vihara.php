<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vihara extends Model
{
    protected $fillable = [
        'district_id',
        'vihara_id',
        'region_id',
        'name',
        'phone_number',
        'address'
    ];

    public function region() {
        return $this->hasOne(Region::class);
    }
}
