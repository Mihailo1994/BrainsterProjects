<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Termin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccommodationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $termin = Termin::where('accommodation_id', $this->id)->orderBy('price_per_night')->get()->first();
        if($termin != null){
            $startDate = Carbon::create($termin->date_from);
            $endDate = Carbon::create($termin->date_until);
            $n_of_nights = $endDate->diffInDays($startDate);
        }

        $images = [];
        foreach($this->images as $image){
            $arr = [
                'image' => $image->image_path,
            ];
            $images[] = $arr;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->accommodationType->type_of_accommodation,
            'location' => [
                'country' => $this->location->country->name,
                'region' => $this->location->region
            ],
            'last_minute' => $this->last_minute,
            'prices_from' => $termin->price_per_night ?? '',
            'number_of_nights' => $n_of_nights ?? '',
            'images' => $images,
        ];
    }
}
