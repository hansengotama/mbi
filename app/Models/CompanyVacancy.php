<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyVacancy extends Model
{
    protected $fillable = [
        'region_id',
        'name',
        'logo_url',
        'city',
        'position',
        'field',
        'detail',
        'from',
        'until',
        'pic_name',
        'pic_email',
        'pic_phone_number'
    ];

    public function region() {
        return $this->hasOne(Region::class);
    }
}
