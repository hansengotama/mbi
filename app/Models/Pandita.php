<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pandita extends Model
{
    protected $fillable = [
        'vihara_id',
        'name',
        'phone_number'
    ];

    public function vihara() {
        return $this->hasOne(Vihara::class);
    }
}
