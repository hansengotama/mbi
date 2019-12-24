<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name',
        'account_number_1',
        'account_number_2',
        'account_name_1',
        'account_name_2',
    ];
}
