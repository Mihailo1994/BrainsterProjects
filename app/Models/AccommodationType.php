<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{
    use HasFactory;

    protected $table = 'accommodation_types';

    protected $fillable = [
        'type_of_accommodation',
    ];

    
}
