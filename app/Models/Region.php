<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'district_id',
        'name'
    ];

    public function viharas() {
        return $this->hasMany(Vihara::class);
    }
}
