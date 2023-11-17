<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Country;
use App\Events\NewOffer;
use App\Models\Location;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    public function index(){
        $offer = Offer::orderBy('id', 'desc')->first();
        if ($offer == null) {
            return view('offers.index', compact('offer'));
        } else {
            $locations = Location::select()->where('id', $offer->location_1)->orWhere('id', $offer->location_2)->orWhere('id', $offer->location_3)->orWhere('id', $offer->location_4)->get();
            return view('offers.index', compact('offer', 'locations'));

        }
    }

    public function add(){
        $countries = Country::all();
        return view('offers.add', compact('countries'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),
        [
            'location_1' => 'required|different:location_2|different:location_3|different:location_4',
            'location_2' => 'required|different:location_3|different:location_4',
            'location_3' => 'required|different:location_4',
            'location_4' => 'required',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        } else {
            $offer = Offer::create([
                'location_1' => $request->location_1,
                'location_2' => $request->location_2,
                'location_3' => $request->location_3,
                'location_4' => $request->location_4,
            ]);
            $subscribers = Subscriber::all();
            event(new NewOffer($subscribers));
            return redirect()->route('offers.index')->with('status', 'Успешно додадовте понуда');
        }
    }

    public function locations(Request $request){
        $country_id = $request->input('id');
        $locations = Location::where('country_id', $country_id)->get()->toArray();
        return response()->json($locations, 200);
    }
}
