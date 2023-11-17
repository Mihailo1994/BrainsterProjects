<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Termin;
use App\Models\Country;
use App\Models\Location;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Http\Resources\CountriesResource;
use App\Http\Resources\TestimonialResource;
use App\Http\Resources\AccommodationsResource;
use App\Http\Resources\AccommodationDetailsResource;

class ApiController extends Controller
{
    public function currentOffer(){
        $offers = Offer::orderBy('id', 'desc')->get()->first();
        $accommodations = Accommodation::where('location_id', $offers->location_1)->orWhere('location_id', $offers->location_2)->orWhere('location_id', $offers->location_3)->orWhere('location_id', $offers->location_3)->with('termins')->with('images')->get();
        return AccommodationsResource::collection($accommodations);
    }

    public function testimonials(){
        $data = Testimonial::orderBy('id', 'desc')->limit('3')->get();
        return TestimonialResource::collection($data);
    }

    public function countries(){
        return CountriesResource::collection(Country::all());
    }

    public function accommodationDetails(Request $request){
        $id = $request->input('id');
        $accommodation = Accommodation::find($id);
        return new AccommodationDetailsResource($accommodation);
    }

    public function accommodationsByCountry(Request $request){
        $id = $request->input('id');
        $accommodations = Accommodation::whereRelation('location', 'country_id', '=', $id)->get();
        return AccommodationsResource::collection($accommodations);
    }

    public function accommodationsByRegion(Request $request){
        $id = $request->input('id');
        $accommodations = Accommodation::whereRelation('location', 'id', '=', $id)->get();
        return AccommodationsResource::collection($accommodations);
    }
}
