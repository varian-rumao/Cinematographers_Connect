<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'business_email', 'profile_picture', 'mobile_number', 'location', 'other_details'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}