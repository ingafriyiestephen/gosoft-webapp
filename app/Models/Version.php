<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Version extends Model
{
    use HasFactory;
    protected $primaryKey = 'version_id';

    protected $fillable = [
        'version_id', 'version_name', 'version_code'
    ];

}
