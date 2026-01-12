<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $primaryKey = 'trip_id';

        /**
     * Get the bookings for the trip.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'trip_id', 'trip_id');
    }


    public function parcels()
    {
        return $this->hasMany(Parcel::class, 'trip_id', 'trip_id');
    }
}
