<?php

namespace App\Models;

use App\Models\Ecommerce\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Member extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'category',
        'company_name',
        'email',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
