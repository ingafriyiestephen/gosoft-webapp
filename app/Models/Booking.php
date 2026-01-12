<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'booking_id';


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    // protected $casts = [
    //     'booking_seat' => 'array',
    // ];

}
