<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'district_id',
        'donors_name',
        'amount'
    ];
}
