<?php

namespace App\Http\Controllers;



use App\Models\Image;
use App\Models\Termin;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\AccommodationImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AccommodationRequest;
use App\Models\Country;
use Psr\Http\Client\NetworkExceptionInterface;

class AccommodationController extends Controller
{
    public function index(){
        $countries = Country::all();

        $accommodations = Accommodation::all();
        return view('accommodation.index', compact('accommodations', 'countries'));
    }

    public function add(){
        $accommodationTypes = AccommodationType::all();
        $locations = Location::all();
        return view('accommodation.add', compact('accommodationTypes', 'locations'));
    }

    public function store(AccommodationRequest $request){
        $request->validated();
        $exists = Accommodation::where('name', $request->name)->where('location_id', $request->location_id)->get();
        if($exists->first()){
            return back()->withErrors('Сместување со тоа име веќе постои на таа локација');
        } else {
            $accommodation = new Accommodation();
            $accommodation->name = $request->name;
            $accommodation->rating = $request->rating;
            $accommodation->accommodation_type_id = $request->accommodation_type;
            $accommodation->description = $request->description;
            $accommodation->location_id = $request->location_id;
            $accommodation->save();
            $accommodationId = $accommodation->id;
            foreach($request->file('images') as $image){
                $path = $image->store('images/accommodations');
                $image = new Image();
                $image->image_path = $path;
                $image->accommodation_id = $accommodationId;
                $image->save();
            }
            return redirect()->route('accommodation.show', $accommodationId);
        }
    }

    public function show($id){
        $accommodation = Accommodation::find($id);
        return view('accommodation.show', compact('accommodation'));
    }

    public function delete(Request $request, $id){
        $accommodation = Accommodation::find($id);
        foreach($accommodation->images as $image){
            Storage::delete($image->image_path);
            $image->delete();
        }
        if ($accommodation->delete()){
            return redirect()->route('accommodation.index')->with('status', 'Успешно избришавте сместување');
        } else {
            return back()->withErrors('Проблем при бришење на сместувањето, пробајте повторно');
        }
    }

    public function edit($id){
        $accommodation = Accommodation::find($id);
        $locations = Location::all();
        $accommodationTypes = AccommodationType::all();
        return view('accommodation.edit', compact('accommodation', 'accommodationTypes', 'locations'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),
        [   'name' => 'required',
            'rating' => 'required',
            'accommodation_type' => 'required',
            'location_id' => 'required',
            'description' => 'required',
        ],
        [
           'required.name' => 'Полето за име е празно',
           'required.rating' => 'Полето за рејтинг е празно',
           'required.accommodation_type' => 'Полето за тип на сместување е празно',
           'required.location_id' => 'Полето за локација е празно',
           'required.description' => 'Полето за опис е празно'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $exists = Accommodation::where('name', $request->name)->where('location_id', $request->location_id)->where('id', '!=', $id)->get();
        if($exists->first()){
            return back()->withErrors('Сместување со тоа име веќе постои на таа локација');
        } else {
            $accommodation = Accommodation::find($id);
            $accommodation->name = $request->name;
            $accommodation->rating = $request->rating;
            $accommodation->accommodation_type_id = $request->accommodation_type;
            $accommodation->description = $request->description;
            $accommodation->location_id = $request->location_id;
            $accommodation->save();
            if($request->file('images') != null){
                foreach($request->file('images') as $image){
                    $path = $image->store('images/accommodations');
                    $image = new Image();
                    $image->image_path = $path;
                    $image->accommodation_id = $accommodation->id;
                    $image->save();
                }
            }

            return redirect()->route('accommodation.show', $accommodation->id)->with('status', 'Направивте успешно изменување');
        }
    }

    public function offerAdd(Request $request){
        $accommodation = Accommodation::find($request->id);
        $accommodation->last_minute = TRUE;
        if ($accommodation->save()) {
            return back()->with('status', 'Успешно го додадовте во понуда');
        } else {
            return back()->withErrors('Проблем при додавање во понуда');
        }
    }

    public function offerRemove(Request $request){
        $accommodation = Accommodation::find($request->id);
        $accommodation->last_minute = FALSE;
        if ($accommodation->save()) {
            return back()->with('status', 'Успешно го отстранивте од понуда');
        } else {
            return back()->withErrors('Проблем при отстранување во понуда');
        }
    }


}


