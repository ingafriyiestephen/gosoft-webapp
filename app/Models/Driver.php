<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $primaryKey = 'driver_id';

    protected $fillable = [
        'driver_name',
        'phone',
        'location',
        'license_number',
        'ghana_card_number',
        'condition',
        'driver_image',
    ];
}
