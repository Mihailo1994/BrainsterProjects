<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_1',
        'location_2',
        'location_3',
        'location_4',
    ];

    public function region(){
        return $this->belongsTo(Locatin::class);
    }
}
