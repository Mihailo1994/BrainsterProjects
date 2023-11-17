<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $termins = [];
        $images = [];
        foreach($this->termins as $termin){
            $arr = [
                'date_from' => $termin->date_from,
                'date_until' => $termin->date_until,
                'price_per_night' => $termin->price_per_night,
                'status' => $termin->is_reserved
            ];
            $termins[] = $arr;
        }
        foreach($this->images as $image){
            $arr = [
                'image' => $image->image_path
            ];
            $images[] = $arr;
        }


        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->accommodationType->type_of_accommodation,
            'rating' => $this->rating,
            'last_minute' => $this->last_minute,
            'location' => [
                'country' => $this->location->country->name,
                'region' => $this->location->region
            ],
            'termins' => $termins,
            'images' => $images
        ];
    }
}
