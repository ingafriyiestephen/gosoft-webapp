<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelType extends Model
{
    use HasFactory;
    protected $primaryKey = 'parcel_type_id';

    protected $fillable = [
        'parcel_type',
    ];
}
