<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    public function accommodationType(){
        return $this->belongsTo(AccommodationType::class);
    }

    public function termins(){
        return $this->hasMany(Termin::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
