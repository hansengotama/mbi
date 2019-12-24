<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestKtub extends Model
{
    protected $fillable = [
        'user_id',
        'accepted_by_admin_id',
        'id_number',
        'family_card_number',
        'last_education',
        'photo_url',
        'visudhi_name',
        'visudhi_place',
        'visudhi_teacher',
        'visudhi_role',
        'business_name',
        'is_accepted',
        'district_id'
    ];

    public function user() {
        $this->hasOne('user_id');
    }

    public function acceptedByAdmin() {
        $this->hasOne('user_id', 'id', 'accepted_by_admin_id');
    }
}
